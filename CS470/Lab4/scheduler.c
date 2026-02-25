// Lab 4 - 470
// Isak Jacobson
// scheduler.c
// 2/24/2026

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>

#define MAX_PROCESSES 100

// Process Structure
typedef struct {
    int pid;
    int arrival_time;
    int burst_time;
    int remaining_time; // For preemptive
    int waiting_time;
    int turnaround_time;
    int completion_time;
}Process;

// Prints the times of each process
void printResults(Process proc[], int num) {
    double total_wait = 0;
    double total_turnaround = 0;
    
    printf("\nRESULTS:\n\n");
    
    for(int i = 0; i < num; i++) {
        printf("---------------------------------------------------------------\n");
        printf("PID <%d>\n", proc[i].pid); 
        printf("Arrival Time <%d>  Burst Time <%d>\n", proc[i].arrival_time, proc[i].burst_time);
        printf("Waiting Time <%d>  Turnaround Time <%d>\n", proc[i].waiting_time, proc[i].turnaround_time);
        
        total_wait += proc[i].waiting_time;
        total_turnaround += proc[i].turnaround_time;
    }
    printf("---------------------------------------------------------------");
    
    printf("\n Average Waiting Time: %.2f\n", total_wait / num);
    printf("\n Average Turnaround Time: %.2f\n", total_turnaround / num);
}

// Prints the process execution order for each type of scheduler
void printExecutionOrder(int order[], int size) {
    printf("\nEXECUTION ORDER: ");
    for (int i = 0; i < size; i++) {
        printf("P%d ", order[i]);
    }
    printf("\n");
}

// Shortest Job First Algorithm
void runSJF(Process processes[], int num_processes) {
    int time = 0;
    int complete_processes = 0;
    int execution_order[1000];
    int order_index = 0;
    int last_pid = -1;
    int current_pid = -1;
        
    
    while (complete_processes < num_processes) {
        int shortest = -1;
        int min_remaining = 1e9;
        
        // find shortest remaining job that has arrived
        for (int p = 0; p < num_processes; p++) {
            if(processes[p].arrival_time <= time && processes[p].remaining_time > 0 &&
               processes[p].remaining_time < min_remaining) {
                    
                    min_remaining = processes[p].remaining_time;
                    shortest = p;
                    
               }
        }
        
        // Shortest not arrived
        if (shortest == -1) {
            time++;
            continue;
        }
        
        // Execute shortest for 1 unit of time        
        processes[shortest].remaining_time--;
        current_pid = processes[shortest].pid;
        
        // Does not allow for duplicates of the same process in the execution order
        if (current_pid != last_pid) {
          execution_order[order_index++] = current_pid;
          last_pid = current_pid;
        }
        time++;
        
        // Check if process is finished
        if (processes[shortest].remaining_time == 0) {
            complete_processes++;
            processes[shortest].completion_time = time;
            processes[shortest].turnaround_time = time - processes[shortest].arrival_time;
            processes[shortest].waiting_time = processes[shortest].turnaround_time - processes[shortest].burst_time;
        }
    }
    
    printExecutionOrder(execution_order, order_index);
    printResults(processes, num_processes);
}

void runRR(Process processes[], int num_processes, int quantum) {
    int time = 0;
    int complete_processes = 0;
    int queue[MAX_PROCESSES];
    int front = 0;
    int rear = 0;
    int visited[MAX_PROCESSES] = {0};

    int execution_order[1000];
    int order_index = 0;
    int last_pid = -1;
    int current_pid = -1;
    
    // Reinitialize Processes
    for (int r = 0; r < num_processes; r++) {
        processes[r].remaining_time = processes[r].burst_time;
        processes[r].waiting_time = 0;
        processes[r].turnaround_time = 0;
        processes[r].completion_time = 0;
    }
    
    // Add first arrivals to back of the queue
    for (int i = 0; i < num_processes; i++) {
        // First Arrivals = arrival time 0
        if (processes[i].arrival_time == 0) {
            queue[rear++] = i;
            visited[i] = 1;
        }
    }

    while (complete_processes < num_processes) {
        if (front == rear) {
            time++;
        
            // admit arrivals while idle
            for (int i = 0; i < num_processes; i++) {
                if (!visited[i] && processes[i].arrival_time <= time) {
                    queue[rear++] = i;
                    visited[i] = 1;
                }
            }

            continue;
        }
        
        // Remove the head process from the queue
        int p = queue[front++];
        
        // Determine the execution time, cannot be longer than the quantum
        int exec_time = (processes[p].remaining_time < quantum)
                        ? processes[p].remaining_time
                        : quantum;
                        
        // Execute Processes
        processes[p].remaining_time -= exec_time;
        time += exec_time;
        current_pid = processes[p].pid;
        
        // Does not allow for duplicates of the same process in the execution order
        if (current_pid != last_pid) {
          execution_order[order_index++] = current_pid;
          last_pid = current_pid;
        }
        
        // Add newly arrived processes
        for (int i = 0; i < num_processes; i++) {
            if (!visited[i] && processes[i].arrival_time <= time) {
                queue[rear++] = i;
                visited[i] = 1;
            }
        }
        
        // Check if a processes is finished, if it isn't return to the end of the queue
        if (processes[p].remaining_time > 0) {
            queue[rear++] = p;
        } else {
            complete_processes++;
            processes[p].completion_time = time;
            processes[p].turnaround_time = time - processes[p].arrival_time;
            processes[p].waiting_time = processes[p].turnaround_time - processes[p].burst_time;
        }
    }

    printExecutionOrder(execution_order, order_index); 
    printResults(processes, num_processes);
}



// Driver
int main(void) {
  int process_num = 0;
  int quantum = 2; // default RR quantum
  
  printf("Welcome to the CPU scheduler simulator:\n");
  printf("=======================================\n");
  
  // Array to hold processes
  Process processes[MAX_PROCESSES];
  
  printf("Enter number of processes > ");
  scanf("%d", &process_num);
  printf("Enter time quantum for RR > ");
  scanf("%d", &quantum);
  
  // Error checking
  if (quantum <= 0) {
        fprintf(stderr, "Error: quantum must be a number larger than 0\n");
        return 1;
  } else if (process_num <= 0) {
        fprintf(stderr, "Error: number of processes must be a number larger than 0\n");
        return 2;
  }
  
  // Initialize process data
  for (int p = 0; p < process_num; p++) {
      processes[p].pid = p + 1;
      
      printf("Process %d arrival time > ", p + 1);
      scanf("%d", &processes[p].arrival_time);
      
      printf("Process %d burst time > ", p + 1);
      scanf("%d", &processes[p].burst_time);
      
      // Error checking
      if(processes[p].arrival_time < 0 || processes[p].burst_time < 0) {
          fprintf(stderr, "Error: arrival time and process time must be positive numbers \n");
          p--;
          continue;
      }
      
      processes[p].remaining_time = processes[p].burst_time;
      processes[p].waiting_time = 0;
      processes[p].turnaround_time = 0;
      processes[p].completion_time = 0;
  }
  
  // Run Algorithms
  printf("\nRunning Shortest Job First... \n");
  sleep(1); // Artificial delay outside of the simulation
  runSJF(processes, process_num);
  
  
  
  printf("\nRunning Round Robin... \n");
  sleep(1); // Artificial delay outside of the simulation
  runRR(processes, process_num, quantum);
  
  return 0;
}
