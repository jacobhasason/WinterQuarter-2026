// Lab 5 - 470
// Isak Jacobson
// Isak_libFS.c, Isak_libFS.h, <<Isak_testFS.c>>
// 3/4/2026

// This is the client/test file for the file system

#include <stdio.h>
#include "Isak_libFS.h"

int main() {
    int choice;
    FILE *fp;
    char filename[] = "Isak_Introduction.txt";
    char inputText[] = "My name is Isak Jacobson.\n"
                       "I am studying Computer Science.\n\n"
                       "I want to get into Game Development as a career.\n"
                       "However, it's a difficult industry to break into."; 

    do {
        printf("\n---------------------\n");
        printf("FILE SYSTEM MENU:\n");
        printf("Recommended: execute steps in order\n");
        printf("\n1. Create %s\n", filename);
        printf("2. Write To %s\n", filename);
        printf("3. Read %s\n", filename);
        printf("4. Delete %s\n", filename);
        printf("5. Exit\n");
        printf("Enter choice > ");
        scanf("%d", &choice);

        // File system menu handling
        switch(choice) {
            // Create
            case 1:
                fp = fileCreate(filename);
                fileClose(fp, filename);
                break;
            // Write
            case 2:
                fp = fileOpen(filename);
                fileWrite(fp, inputText, filename);
                fileClose(fp, filename);
                break;
            // Read
            case 3:
                fp = fileOpen(filename);
                fileRead(fp, filename);
                fileClose(fp, filename);
                break;
            // Delete
            case 4:
                fileDelete(filename);                
                break;
        }

    } while(choice != 5);

    return 0;
}
