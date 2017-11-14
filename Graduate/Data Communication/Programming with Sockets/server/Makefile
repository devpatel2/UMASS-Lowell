CC=g++

CFLAGS=-c -Wall -Werror -ansi -pedantic

all: myserver

myserver: myserver.o
	$(CC) myserver.o -o myserver

myserver.o: myserver.cpp
	$(CC) $(CFLAGS) myserver.cpp

clean:
	rm -rf *o myserver