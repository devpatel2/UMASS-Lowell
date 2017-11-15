#include <iostream>
#include <fstream>
#include <string>
using namespace std;

#ifndef MATRIX_H
#define MATRIX_H

const int n = 3;
void equal(int x);

class MATRIX
{
public:
	void matrix();			//default constructor creating a matrix with elements =0,
	void matrix(int n);		//constructor creating a diagonal matrix (n-s on the main diagonal, 0 –everywhere else)
	int det();				//function computing determinant of a matrix 
	~MATRIX();
	friend bool operator == (const MATRIX& matrix1, const MATRIX& matrix2);
	friend MATRIX operator - (const MATRIX& matrix);
	friend MATRIX operator + (const MATRIX& matrix1, const MATRIX& matrix2);
	friend MATRIX operator - (const MATRIX& matrix1, const MATRIX& matrix2);
	friend MATRIX operator * (const MATRIX& matrix1, const MATRIX& matrix2);
	friend MATRIX operator * (int k, const MATRIX& matrix);
	friend istream& operator >> (istream& ins, MATRIX& matrix);
	friend ostream& operator << (ostream& outs, const MATRIX& matrix);
private:
	int e[n][n];
};

#endif