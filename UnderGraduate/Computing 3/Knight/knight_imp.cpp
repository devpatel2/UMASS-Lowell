//Implementation File

#include <iostream>
#include <string>
#include "knight.h"
using namespace std;

void KNIGHT::knight()
{
	knightHealth = 10;
	knightName = "King Arthur";

	cout << "Knight Joined" << endl;
	intro();

	s_total++;
}

void KNIGHT::knight(int hp, string name)
{
	knightHealth = hp;
	knightName = name;

	cout << "Knight Joined" << endl;
	intro();

	s_total++;
}

void KNIGHT::knight(const KNIGHT& c) //copy constructor
{
	knightHealth = c.knightHealth;
	knightName = "copy " + c.knightName;
	cout << "A new knight has joined!" << endl;
	intro();

	s_total++; 
}

void KNIGHT::intro()
{
	cout << "I am " << knightName << " with hp of " << knightHealth << endl;
}

KNIGHT::~KNIGHT() //destructor
{
	cout << "Knight " << knightName << " has left!" << endl;

	s_total--;
	cout << "The total number of knights: " << KNIGHT::getTotal() << endl;
}

void KNIGHT::getKnightName()
{
	cout << "Knight's name is " << knightName << endl;
}
void KNIGHT::getKnightHealth()
{
	cout << "Knight's health is " << knightHealth << endl;
}

void KNIGHT::setKnightName(string name)
{
	cout << "Knight " << knightName;

	knightName = name;

	cout << "'s new name is " << knightName << endl;
}

void KNIGHT::setKnightHealth(int hp)
{
	cout << "Knight " << knightName;

	knightHealth = hp;

	cout << " health is now " << knightHealth << endl;
}

int KNIGHT::knightTasks()
{
	int task;

	cout << "What should the knight " << knightName << " do?" << endl;
	cout << "0) Done for the day" << endl << "1) Train" << endl << "2) Eat" << endl;
	cin >> task;

	if (task == 1)
	{
		train();
		cout << endl;
		return 1;
	}
	else if (task == 2)
	{
		eat();
		cout << endl;
		return 1;
	}
	else
	{
		cout << "Knight " << knightName << "is done for the day" << endl;
		return 0;
	}
}

void KNIGHT::train()
{
	knightHealth -= 2;

	cout << "Knight " << knightName << " health is now " << knightHealth << endl;
}

void KNIGHT::eat()
{
	knightHealth += 3;

	cout << "Knight " << knightName << " health is now " << knightHealth << endl;
}

int KNIGHT::getTotal()
{
	return s_total;
}