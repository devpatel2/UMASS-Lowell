//Implementation File

#include <stdlib.h>
#include <iostream>
#include <string>
#include "knight.h"
#include "box.h"
#include <time.h>
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

int combineHp(const KNIGHT& knight1, const KNIGHT& knight2)
{
	int hp;

	hp = knight1.knightHealth + knight2.knightHealth;

	return hp;
}

void BOX::box()
{
	multiplier = 1;
	cout << "Box created!" << endl;
	
}

void BOX::mysteryBox(class KNIGHT& knight)
{ 
	int x, mult;
	
	cout << knight.knightName << " uses the mystery box!" << endl;
	mult = (rand()) % 5;
	x = (rand()) % 100;

	if (mult < 3)
		multiplier = 1;
	else if (mult == 4)
		multiplier = 3;
	else
		multiplier = 5;

	if (x <= 9)
		knight.knightHealth -= (10 * multiplier);
	else if (x >= 10 && x <= 29)
		knight.knightHealth -= (3 * multiplier);
	else if (x >= 30 && x <= 79)
		knight.knightHealth -= (0 * multiplier);
	else if (x >= 80 && x <= 95)
		knight.knightHealth += (5 * multiplier);
	else
		knight.knightHealth += (50 * multiplier);

	cout << knight.knightName << " now has " << knight.knightHealth << " hp!" << endl;
}