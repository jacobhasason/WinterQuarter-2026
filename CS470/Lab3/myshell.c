// Lab 3 - 470
// Isak Jacobson
// myshell.c
// 2/18/2026

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>     // fork, execvp, chdir, dup2
#include <sys/wait.h>   // waitpid
#include <fcntl.h>      // open flags
#include <errno.h>

#define MAX_LINE 1024
#define MAX_TOKENS 100  

 // Parse the input line into tokens
        //    - Split by whitespace
        //    - Handle special characters (<, >, >>)
        //    - Returns number of tokens and updates tokens array 
int parseTokens(char* line, char *tokens[]) {
  
  // token count
  int count = 0;
  // Split token at space, tab or new line
  char *token = strtok(line, " \t\n");
  
  // Parse all tokens
  while(token != NULL && count < MAX_TOKENS - 1) {
      
      // Check if token starts with a quote and combine all under quotes into a single token
      if(token[0] == '"') {
            char *startToken = token + 1;  // skip opening quote
            char *endToken = token;
          
          // Keep combining until ending quote found
          while (endToken[strlen(token) - 1] != '"') {
              char *next = strtok(NULL, " \t\n");
              
              // Break if early EOF
              if (next == NULL) {
                break;
              }
            
              endToken[strlen(endToken)] = ' ';
              endToken = next;
          }
          
          // Remove ending quote
          int len = strlen(endToken);
          if(len > 0 && endToken[len - 1] == '"') {
              endToken[len - 1] = '\0';
          }
          tokens[count++] = startToken;
      } else {
        // Token doesn't start with quote 
        tokens[count++] = token;
      }
      
      token = strtok(NULL, " \t\n");
  }
  
  tokens[count] = NULL;
  return count;
  
}


// Check for built-in commands
        //    - "cd [dir]" - change directory
        //    - "exit" - exit the shell
int handleBuiltins(char *tokens[]) {
    if (tokens[0] == NULL) {
        return 1; // nothing typed, treat as handled
    }

    // exit
    if (strcmp(tokens[0], "exit") == 0) {
        // Exit the shell program
        printf("Goodbye!\n");
        exit(0);
    }

    // cd [dir]
    if (strcmp(tokens[0], "cd") == 0) {
        // If no directory specified, go to HOME
        const char *path = tokens[1];
        if (path == NULL) {
            path = getenv("HOME");
            if (path == NULL) {
                path = "/"; // fallback
            }
        }

        if (chdir(path) != 0) {
            perror("cd");
        }

        return 1; // handled
    }

    return 0; // not a builtin
}


// Handle redirection
        //    - < for input redirection
        //    - > for output redirection
        //    - >> for append redirection
        // ============================================
int handleRedirection(char *tokens[]) {
    for (int i = 0; tokens[i] != NULL; i++) {
        
        // Input redirection: <
        if (strcmp(tokens[i], "<") == 0) {
            
            // Misuse
            if (tokens[i + 1] == NULL) {
                fprintf(stderr, "Syntax error: missing filename after <\n");
                return -1;
            }
            
            // Attempt to open the file following the '<'
            int fileIndex = open(tokens[i + 1], O_RDONLY);
            if (fileIndex < 0) {
                // File error
                perror(tokens[i + 1]);
                return -1;
            }

            // Replace stdin with this file
            if (dup2(fileIndex, STDIN_FILENO) < 0) {
                perror("dup2");
                close(fileIndex);
                return -1;
            }
            close(fileIndex);

            // Remove "< filename" from argv by shifting left 2 slots
            for (int j = i; tokens[j] != NULL; j++) {
                tokens[j] = tokens[j + 2];
            }
            i--; // re-check same index in case multiple redirects
        }

        // Output redirection overwrite: >
        else if (strcmp(tokens[i], ">") == 0) {
            
            // Misuse
            if (tokens[i + 1] == NULL) {
                fprintf(stderr, "Syntax error: missing filename after >\n");
                return -1;
            }
            
            // Attempt to open the file following the '>'
            int fileIndex = open(tokens[i + 1], O_WRONLY | O_CREAT | O_TRUNC, 0644);
            if (fileIndex < 0) {
                // File error
                perror(tokens[i + 1]);
                return -1;
            }

            // Replace stdout with this file
            if (dup2(fileIndex, STDOUT_FILENO) < 0) {
                perror("dup2");
                close(fileIndex);
                return -1;
            }
            close(fileIndex);

            // Remove "> filename"
            for (int j = i; tokens[j] != NULL; j++) {
                tokens[j] = tokens[j + 2];
            }
            i--;
        }

        // Output redirection append: >>
        else if (strcmp(tokens[i], ">>") == 0) {
        
            // Misuse
            if (tokens[i + 1] == NULL) {
                fprintf(stderr, "Syntax error: missing filename after >>\n");
                return -1;
            }
            
            // Attempt to open the file following the '>'
            int fileIndex = open(tokens[i + 1], O_WRONLY | O_CREAT | O_APPEND, 0644);
            if (fileIndex < 0) {
                // File error
                perror(tokens[i + 1]);
                return -1;
            }

            // Replace stdout with this file
            if (dup2(fileIndex, STDOUT_FILENO) < 0) {
                perror("dup2");
                close(fileIndex);
                return -1;
            }
            close(fileIndex);

            // Remove ">> filename"
            for (int j = i; tokens[j] != NULL; j++) {
                tokens[j] = tokens[j + 2];
            }
            i--;
        }
    }

    return 0;
}



// Execute external commands
        //    - fork() to create child process
        //    - execvp() to run the command
        //    - waitpid() to wait for completion

int execute(char* tokens[]) {
    pid_t pid = fork();

    if (pid < 0) {
        perror("fork");
        return -1;
    }
    
     if (pid == 0) {
        // CHILD
        // Apply <, >, >> redirection before exec
        if (handleRedirection(tokens) != 0) {
            // redirection setup failed
            exit(1);
        }

        execvp(tokens[0], tokens);

        // If execvp returns, it failed
        perror(tokens[0]);
        exit(127);
    } else {
        // PARENT
        int status = 0;
        if (waitpid(pid, &status, 0) < 0)
        {
            perror("waitpid");
        }
    }
    return 0;
}



int main(void) {
    char line[MAX_LINE];

    while (1) {
        printf("myshell> ");
        fflush(stdout);

        if (!fgets(line, sizeof(line), stdin)) {
            // Exit (Ctrl-D) or input error
            printf("\nGoodbye!\n");
            break;
        }

        // If user presses Enter
        if (line[0] == '\n') {
            continue;
        }

        // Parse into tokens
        char *tokens[MAX_TOKENS];
        parseTokens(line, tokens);

        // Builtins run in parent (cd must affect shell process)
        if (handleBuiltins(tokens)) {
            continue;
        }
        

        // Execute commands
        execute(tokens);
    }

    return 0;
}



