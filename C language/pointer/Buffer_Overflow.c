#include <stdio.h>
#include <string.h>

void vulnerableFunction(char *str) {
  char buffer[10];
  strncpy(buffer, str, sizeof(buffer) - 1); // Replace with strncpy()
  // Add null terminator
  buffer[sizeof(buffer) - 1] = '\0';
  printf("Buffer content: %s\n", buffer);
}

int main() {
  char input[50];
  printf("Enter a string: ");
  scanf("%10s", input); // Use scanf with input size limit
  vulnerableFunction(input);
  return 0;
}
