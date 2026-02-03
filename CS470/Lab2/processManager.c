// Lab 2 - 470
// Isak Jacobson
// processManager.c
// 2/2/2026

#include <stdio.h> 
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>

// Constants 
#define CHILDREN 15
#define NORMAL 0
#define ABORT 1

int main(void) {
	pid_t childPids[CHILDREN];			
	int normalExits = 0; // Number of processes with exit code 0
	int failedExits = 0; // Number of processes with non-zero exit code
	int termExits = 0; // Numbwe of processes whose signal was aborted
	
	printf("Parent PID:%d\n", getpid());

	// Array holding commands
	char *commands[CHILDREN][4] = {
		// Valid Processes
		{"echo", "Hello Isak Jacobson", NULL},
		{"pwd", NULL},
		{"whoami", NULL},
		{"date", NULL},
		{"id", NULL},
		{"cat", "/proc/version", NULL},
		{"ls", "-l", NULL},
		{"hostname", NULL},
		{"printenv", "PATH", NULL},
		{"sleep", "1", NULL},
		
		// Invalid Processes 
		{"crashandburn", NULL},
		{"thiswontwork", NULL},
		
		// Abort Cases
		{NULL},
		{NULL},
		{NULL}
	};
	
	// Behavior Array to distinguish abort cases
	int behavior[CHILDREN] = { NORMAL, NORMAL, NORMAL, NORMAL, NORMAL, NORMAL,
				   NORMAL, NORMAL, NORMAL, NORMAL, NORMAL, NORMAL,
				   NORMAL, NORMAL, ABORT, ABORT, ABORT };
	
	printf( "Running these commands:\n" );
	printf( "---------\n" );
	for(int c = 0; c < CHILDREN; c++) {
		
		printf("Process %d: %s %s\n", c, commands[c][0], commands[c][1]);
	}
	printf( "---------\n");


	// Fork Processes				 
	for(int i = 0; i < CHILDREN; i++) {
		pid_t pid = fork();
		
		if(pid == 0) {
			printf("Running Process Child %d with PID:%d\n", i, getpid());
			
			if(behavior[i] == ABORT) {
				
				abort(); // sends abort signal termination
			}

				
			execvp(commands[i][0], commands[i]);

			// Runs if execution fails
			perror("execvp failed!\n");
			exit(127);
		}

	childPids[i] = pid; 
	}
	
	// Wait for each child in creation order
	for(int j = 0; j < CHILDREN; j++) {
		int status = 0;
		int code = 0; // exit code
		int signal = 0; // termination signal
		pid_t wait = waitpid(childPids[j], &status, 0);
		
		
		if(wait < 0) {
			perror("waitpid failed!\n");
			continue;
		}

		// Non-Aborted Status
		if(WIFEXITED(status)) {
			code = WEXITSTATUS(status);
			printf("***Child[%d] PID=%d exited normally, code=%d***\n", j, 
				(int)childPids[j], code);
		 	
			if(code == 0) {
				normalExits++;
			} else {
				failedExits++;
			}
		// Aborted Status
		} else if (WIFSIGNALED(status)) {
			signal = WTERMSIG(status);

			printf("***Child[%d] PID=%d terminated by signal %d***\n", j,
				(int)childPids[j], signal);
			
			termExits++;
		}
	}

	
	// Summary

	printf("\nSummary\n");
	printf("----------------\n");
	printf("Number of child processes that exited normally: %d\n", normalExits);
	printf("Number of child processes that exited with non-zero exit code: %d\n", failedExits);
	printf("Number of child processes that were terminated by a signal: %d\n", termExits);
	
}
