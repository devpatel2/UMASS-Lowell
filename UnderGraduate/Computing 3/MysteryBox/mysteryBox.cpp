//Devang Patel
//Computing 3, HW2

#include <stdlib.h>
#include <iostream>
#include <string>
#include "knight.h"
#include "box.h"
#include <time.h>
using namespace std;

int KNIGHT::s_total = 0;  // initialize static member variable

int main(int argc, char* argv[])
{
	KNIGHT knight, knight1, knight2;
	BOX box;

	cout << "The total number of knights: " << KNIGHT::getTotal() << endl << endl;

	knight.knight(); //default construtor
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	knight1.knight(50, "Bob"); //constructor with parameters
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	cout << "Newly combined knight created!" << endl;
	knight2.knight(combineHp(knight, knight1), "Duke Bob");
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	srand(time(NULL));
	box.box();

	cout << endl;

	box.mysteryBox(knight2);

	cout << endl;

	return 0;
}