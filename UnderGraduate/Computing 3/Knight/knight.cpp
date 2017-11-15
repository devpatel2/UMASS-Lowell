//Devang Patel
//Computing 3, HW2

#include <iostream>
#include <string>
#include "knight.h"
using namespace std;

int KNIGHT::s_total = 0;  // initialize static member variable

int main(int argc, char* argv[])
{
	KNIGHT knight, knight1, knight2;
	int answer = 1;

	cout << "The total number of knights: " << KNIGHT::getTotal() << endl << endl;

	knight.knight(); //default construtor
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	knight1.knight(50, "Bob"); //constructor with parameters
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	cout << "*copying the object*" << endl; //copy constructor
	knight2.knight(knight1);
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;

	cout << endl;

	cout << "*Accessing Knight Info*" << endl;
	knight1.getKnightName(); //accessor
	knight1.getKnightHealth();

	cout << endl;

	cout << "*Changing Knight Info*" << endl;
	knight2.setKnightName("George"); //mutator
	knight2.setKnightHealth(100);

	cout << endl;

	while (answer != 0)
	{
		answer = knight.knightTasks();
	}

	cout << endl;

	return 0;
}