CC=g++

CFLAGS=-c -Wall -Werror -ansi -pedantic

all: knight

knight: knight_imp.o knight.o
	$(CC) knight_imp.o knight.o -o knight

knight_imp.o: knight_imp.cpp knight.h
	$(CC) $(CFLAGS) knight_imp.cpp

knight.o: knight.cpp knight.h
	$(CC) $(CFLAGS) knight.cpp

clean:
	rm -rf *o knight