// Lab 5 - 470
// Isak Jacobson
// <<Isak_libFS.c>>, Isak_libFS.h, Isak_testFS.c
// 3/4/2026

// This file encapsulates the functionality for the file system

#include "Isak_libFS.h"
#include <stdlib.h>
#include <stdio.h>

// Create a new file
FILE* fileCreate(const char *filename) {
    FILE *fp = fopen(filename, "w");
    if (fp == NULL) {
        printf("\nError creating %s, exiting program!\n", filename);
        perror("");
        exit(1); // Prevent core dump
    }
    printf("\n%s created!\n", filename);
    return fp;
}


// Open an existing file
FILE* fileOpen(const char *filename) {
    FILE *fp = fopen(filename, "r+");
    if (fp == NULL) {
        printf("\nError opening %s, exiting program!\n", filename);
        perror("");
        exit(1); // Prevent core dump
    }
    printf("\n%s opened!\n\n", filename);
    return fp;
}


// Read data from a file
int fileRead(FILE *fp, const char *filename) {
    if (fp == NULL) {
      printf("\nError reading %s, exiting program!\n", filename);
      perror("");
      exit(1); // Prevent core dump
    }

    char buffer[256];
    while (fgets(buffer, sizeof(buffer), fp)) {
        printf("%s", buffer);
    }

    return 0;
}


// Write data to a file
int fileWrite(FILE *fp, const char *text, const char *filename) {
    if (fp == NULL) {
      printf("\nError writing to %s, exiting program!\n", filename);
      perror("");
      exit(1); // Prevent core dump
    }
    fprintf(fp, "%s", text);
    printf("\nInformation written to %s!\n", filename);
    return 0;
}


// Close a file
int fileClose(FILE *fp, const char *filename) {
    int result = fclose(fp);
    
    if (result == 0) {
      printf("\n\n%s closed!\n", filename);
    } else {
      printf("\n\nError closing %s!\n", filename);
      perror("");
    }
    return result;
}


// Delete a file
int fileDelete(const char *filename) {
    int result = remove(filename);
    
    if (result == 0) {
      printf("\n%s deleted!\n", filename);
    } else {
      printf("\nError deleting %s!\n", filename);
      perror("");
    }
}


