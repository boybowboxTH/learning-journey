#include <stdint.h>
#include <stdio.h>
#include <stdlib.h>

typedef uint8_t BYTE;

// Memory Card
const int BLOCK_SIZE = 512;

int main(int argc, char *argv[])
{

    if (argc != 2)
    {
        printf("Usage: ./recover CARD\n");
        return 1;
    }

    FILE *card = fopen(argv[1], "r");
    if (card == NULL)
    {
        printf("Could not open %s.\n", argv[1]);
        return 1;
    }

    BYTE buffer[BLOCK_SIZE];


    int file_count = 0;

    FILE *img = NULL;

    char filename[8];

    while (fread(buffer, 1, BLOCK_SIZE, card) == BLOCK_SIZE)
    {
        if (buffer[0] == 0xff && buffer[1] == 0xd8 && buffer[2] == 0xff && (buffer[3] & 0xf0) == 0xe0)
        {
            if (img != NULL)
            {
                fclose(img);
            }

            sprintf(filename, "%03i.jpg", file_count);

            img = fopen(filename, "w");

            file_count++;
        }

        if (img != NULL)
        {
            fwrite(buffer, 1, BLOCK_SIZE, img);
        }
    }

    if (img != NULL)
    {
        fclose(img);
    }
    
    fclose(card);

    return 0;
}