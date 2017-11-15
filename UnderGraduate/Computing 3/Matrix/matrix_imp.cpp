#include <iostream>
#include <fstream>
#include <string>
#include "matrix.h"
using namespace std;

void MATRIX::matrix()
{
	int i, j;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			e[i][j] = 0;
		}
	}
}

void MATRIX::matrix(int s)
{
	int i, j;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			e[i][j] = 0;
			if (i == j)
				e[i][j] = s;
		}
	}
}

int MATRIX::det()
{
	int determinant;

	determinant = e[0][0] * ((e[1][1] * e[2][2]) - (e[2][1] * e[1][2])) - e[0][1] * (e[1][0] * e[2][2] - e[2][0] * e[1][2]) + e[0][2] * (e[1][0] * e[2][1] - e[2][0] * e[1][1]);

	return determinant;
}

MATRIX::~MATRIX()
{

}

bool operator == (const MATRIX& matrix1, const MATRIX& matrix2)
{
	int i, j;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			if (matrix1.e[i][j] != matrix2.e[i][j])
				return 0;
		}
	}

	return 1;
}

MATRIX operator - (const MATRIX& matrix)
{
	int i, j;
	MATRIX temp;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			temp.e[i][j] = -matrix.e[i][j];
		}
	}

	return temp;
}

MATRIX operator + (const MATRIX& matrix1, const MATRIX& matrix2)
{
	int i, j;
	MATRIX temp;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			temp.e[i][j] = matrix1.e[i][j] + matrix2.e[i][j];
		}
	}

	return temp;
}

MATRIX operator - (const MATRIX& matrix1, const MATRIX& matrix2)
{
	int i, j;
	MATRIX temp;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			temp.e[i][j] = matrix1.e[i][j] - matrix2.e[i][j];
		}
	}

	return temp;
}

MATRIX operator * (const MATRIX& matrix1, const MATRIX& matrix2)
{
	int i, j, k;
	MATRIX temp;

	k = 0;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			temp.e[i][j] = matrix1.e[i][k] * matrix2.e[k][j] + matrix1.e[i][k + 1] * matrix2.e[k + 1][j] + matrix1.e[i][k + 2] * matrix2.e[k + 2][j];
		}
	}

	return temp;
}

MATRIX operator * (int k, const MATRIX& matrix)
{
	int i, j;
	MATRIX temp;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			temp.e[i][j] = matrix.e[i][j] * k;
		}
	}

	return temp;
}

istream& operator >> (istream& ins, MATRIX& matrix)
{
	int i, j;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
		{
			ins >> matrix.e[i][j];
		}
	}
	
	return ins;
}

ostream& operator << (ostream& outs, const MATRIX& matrix)
{
	int i, j;

	for (i = 0; i < n; i++)
	{
		for (j = 0; j < n; j++)
			outs << matrix.e[i][j] << " ";
		outs << endl;
	}

	return outs;
}

void equal(int x)
{
	switch (x)
	{
	case 0:
		cout << "False" << endl;
		break;
	case 1:
		cout << "True" << endl;
		break;
	}
}