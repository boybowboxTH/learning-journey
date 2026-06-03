#include <stdio.h>

void swap(int* a, int* b);

int main(void)
{
    int x = 1;
    int y = 2;

    printf("before swap: x = %i, y = %i\n", x, y);
    
    swap(&x, &y);

    printf("after swap: x = %i, y = %i\n", x, y);
}

void swap(int* a, int* b)
{
    int tmp = *a; 
    *a = *b;    
    *b = tmp;   
}