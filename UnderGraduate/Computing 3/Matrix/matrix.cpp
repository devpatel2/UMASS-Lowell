#include <stdlib.h>
#include <iostream>
#include <fstream>
#include <string>
#include "matrix.h"
using namespace std;

int main(int argc, char* argv[])
{
	MATRIX Z, E, D, A, B, C;
	int x, det;
	ifstream input;

	input.open("inputfile.txt");
	if (input.fail())
	{
		cout << "Input file opening failed.\n";
		exit(1);
	}

	Z.matrix();
	E.matrix(1);
	D.matrix(2);

	input >> A;
	input >> C;

	cout << "Z: \n" << Z << endl;
	cout << "E: \n" << E << endl;
	cout << "D: \n" << D << endl;
	cout << "A: \n" << A << endl;

	input.close();
	
	B = A;

	x = B == A;
	cout << "B == A: ";
	equal(x);

	cout << endl;

	cout << "A + D = \n" << endl << A + D << endl;
	cout << "A - D = \n" << endl << A - D << endl;
	cout << "A * D = \n" << endl << A * D << endl;

	x = A - B == Z;
	cout << "A - B == Z: ";
	equal(x);
	x = -A == Z - A;
	cout << "-A == Z - A: ";
	equal(x);
	x = A + B == A * D;
	cout << "A + B == A * D: ";
	equal(x);
	x = A * E == A;
	cout << "A * E == A: ";
	equal(x);
	x = A * D == 2 * A;
	cout << "A * D == 2 * A: ";
	equal(x);

	cout << endl;
	det = E.det();
	cout << "Determinant of E: " << det << endl;
	det = D.det();
	cout << "Determinant of D: " << det << endl;

	cout << endl << "*Determinant property*" << endl;
	det = (A * C).det() == A.det() * C.det();
	cout << "Determinant of (A * C) ==  Determinant of A * Determinant of C: ";
	equal(det);

	cout << endl;

	return 0;
}