# Define the C compiler to use
CC=gcc

# Define any compile-time flags
CFLAGS=-Wall -g

# Define the target executable name
TARGET=processManager

all: $(TARGET)

# The target will be rebuilt when 'make' is run
$(TARGET): $(TARGET).c
	$(CC) $(CFLAGS) -o $(TARGET) $(TARGET).c

