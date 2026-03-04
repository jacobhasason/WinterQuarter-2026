// Lab 5 - 470
// Isak Jacobson
// Isak_libFS.c, <<Isak_libFS.h>>, Isak_testFS.c
// 3/4/2026

// This is the header file for all functions for the file system

#ifndef ISAK_LIBFS_H
#define ISAK_LIBFS_H

#include <stdio.h>

FILE* fileCreate(const char *filename);
FILE* fileOpen(const char *filename);
int fileWrite(FILE *fp, const char *text, const char *filename);
int fileRead(FILE *fp, const char *filename);
int fileClose(FILE *fp, const char *filename);
int fileDelete(const char *filename);

#endif
