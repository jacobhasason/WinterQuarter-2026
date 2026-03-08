#include <stdio.h>
#include <stdlib.h>

#define PAGE_SIZE 1024
#define NUM_FRAMES 1024

int main(void) {
    // One process, 4 pages
    const int num_pages = 4;

    // Hardcoded page to frames
    int page_table[] = {5, 2, 9, 1};

    // Print page table
    printf("Paging config:\n");
    printf("PAGE_SIZE = %d bytes\n", PAGE_SIZE);
    printf("NUM_FRAMES = %d (Physical Mem = %d bytes)\n",
           NUM_FRAMES, NUM_FRAMES * PAGE_SIZE);

    printf("Page Table\n");
    for (int p = 0; p < num_pages; p++) {
        printf("page %d -> frame %d\n", p, page_table[p]);
    }

    printf("\n");

    int n;
    printf("Enter number of logical addresses (N): ");
    if (scanf("%d", &n) != 1 || n < 0) {
        fprintf(stderr, "Invalid N\n");
        return EXIT_FAILURE;
    }

    printf("Enter %d logical addresses, one per line:\n", n);

    for (int i = 0; i < n; i++) {
        long logical;

        if (scanf("%ld", &logical) != 1) {
            fprintf(stderr, "Invalid logical input\n");
            return EXIT_FAILURE;
        }

        if (logical < 0) {
            printf("[%d] logical = %ld -> INVALID (negative address)\n", i, logical);
            continue;
        }

        long page = logical / PAGE_SIZE;
        long offset = logical % PAGE_SIZE;

        printf("[%d] logical = %ld -> page = %ld offset = %ld",
               i, logical, page, offset);

        if (page >= num_pages) {
            printf(" -> INVALID (page out of range)\n");
            continue;
        }

        int frame = page_table[page];

        if (frame < 0) {
            printf(" -> page %ld INVALID\n", page);
            continue;
        }

        long physical = (long)frame * PAGE_SIZE + offset;
        printf(" -> frame = %d -> physical = %ld\n", frame, physical);
    }

    return EXIT_SUCCESS;
}
