#include <iostream>
#include <string>
using namespace std;

#ifndef KNIGHT_H
#define KNIGHT_H

class KNIGHT
{
public:	
	void knight();
	void knight(int hp, string name);
	void knight(const KNIGHT& c); //copy constructor
	void intro();
	~KNIGHT(); //destructor
	void getKnightName(); //accessor
	void getKnightHealth(); //accessor
	void setKnightName(string name); //mutator
	void setKnightHealth(int hp); //mutator
	int knightTasks();
	void train();
	void eat();
	static int getTotal(); // returns total objects
private:
	string knightName;
	int knightHealth;
	static int s_total; //static member variable. counts number of objects
};

#endif