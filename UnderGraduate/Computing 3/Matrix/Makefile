CC=g++

CFLAGS=-c -Wall -Werror -ansi -pedantic

all: matrix

matrix: matrix_imp.o matrix.o
	$(CC) matrix_imp.o matrix.o -o matrix

matrix_imp.o: matrix_imp.cpp matrix.h
	$(CC) $(CFLAGS) matrix_imp.cpp

matrix.o: matrix.cpp matrix.h
	$(CC) $(CFLAGS) matrix.cpp

clean:
	rm -rf *o matrix