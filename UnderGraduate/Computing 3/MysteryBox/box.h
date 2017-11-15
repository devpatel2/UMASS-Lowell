#include <iostream>
#include <string>
using namespace std;

#ifndef BOX_H
#define BOX_H

class BOX
{
public:
	void box();
	void mysteryBox(class KNIGHT& knight); //the function takes a parameter of class KNIGHT and randomly adds or removes hp of a specifed knight. hp can also be multiplied 
										   //using the private member variable multiplier
private:
	int multiplier;
};

#endif