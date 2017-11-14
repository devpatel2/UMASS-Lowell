CC=g++

CFLAGS=-c -Wall -Werror -ansi -pedantic

all: myclient

myclient: myclient.o
	$(CC) myclient.o -o myclient

myclient.o: myclient.cpp
	$(CC) $(CFLAGS) myclient.cpp

clean:
	rm -rf *o myclient