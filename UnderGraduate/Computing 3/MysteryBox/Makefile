CC=g++

CFLAGS=-c -Wall -Werror -ansi -pedantic

all: mysteryBox

mysteryBox: mysteryBox_imp.o mysteryBox.o
	$(CC) mysteryBox_imp.o mysteryBox.o -o mysteryBox

mysteryBox_imp.o: mysteryBox_imp.cpp knight.h box.h
	$(CC) $(CFLAGS) mysteryBox_imp.cpp

mysteryBox.o: mysteryBox.cpp knight.h box.h
	$(CC) $(CFLAGS) mysteryBox.cpp

clean:
	rm -rf *o mysteryBox