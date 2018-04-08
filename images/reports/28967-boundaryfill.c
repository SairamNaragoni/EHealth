// BoundaryFill ALGO.........
#include <stdio.h>
#include <math.h>
#include <GL/glut.h>

//structure for storing coordiantes of a pixel
struct Point {
    GLint x;
    GLint y;
};

//structure for storing rgb components of a color
struct Color {
    GLfloat r;
    GLfloat g;
    GLfloat b;
};

//function which returns current color of the pixel provided
struct Color getPixelColor(GLint x, GLint y) {
    struct Color color;
    glReadPixels(x, y, 1, 1, GL_RGB, GL_FLOAT, &color);
    return color;
}

//function to set the color to the given pixel
void setPixelColor(GLint x, GLint y, struct Color color) {
    printf("set %d %d",x,y);
    glColor3f(color.r, color.g, color.b);
    glBegin(GL_POINTS);
    glVertex2i(x, y);
    glEnd();
    glFlush();
}
void drawPolygon(){
    printf("draw\n");
    glClear(GL_COLOR_BUFFER_BIT);
    glLineWidth(1.0);
    glBegin(GL_LINE_LOOP);

    glVertex2i(120,120);
    glVertex2i(300,120);
    glVertex2i(300,300);
   // glVertex2i(210,390);
    glVertex2i(120,300);
   
    glEnd();
    glFlush();


}

void boundaryFill(GLint x, GLint y, struct Color bColor, struct Color fColor) {
    printf("%d %d\n",x,y);
    struct Color color;
    color = getPixelColor(x, y);
    printf("%f %f %f\n",color.r,color.g,color.b);
   if( !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b)){
     setPixelColor(x, y, fColor);
   }
   
   color = getPixelColor(x+1, y);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x+1, y, bColor, fColor);
   }

   color = getPixelColor(x, y+1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x, y+1, bColor, fColor);
   }

   color = getPixelColor(x-1, y);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x-1, y, bColor, fColor);
   }

   color = getPixelColor(x, y-1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x, y-1, bColor, fColor);
   }

//8fill
   
   color = getPixelColor(x+1, y-1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x+1, y-1, bColor, fColor);
   }
   
   color = getPixelColor(x-1, y+1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x-1, y+1, bColor, fColor);
   }

  color = getPixelColor(x-1, y-1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x-1, y-1, bColor, fColor);
   }

  color = getPixelColor(x+1, y+1);
   if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !(color.r == fColor.r && color.g == fColor.g && color.b == fColor.b) ){
       boundaryFill(x+1, y+1, bColor, fColor);
   }
  
   /*
    if( !(color.r == bColor.r && color.g == bColor.g && color.b == bColor.b)  && !( color.r == fColor.r && color.g == fColor.g && color.b == fColor.b ) )
    {
        setPixelColor(x, y, fColor);
        printf("%d %d",x,y);

        boundaryFill(x+1, y, bColor, fColor);
        boundaryFill(x, y+1, bColor, fColor);
        boundaryFill(x-1, y, bColor, fColor);
        boundaryFill(x, y-1, bColor, fColor);
    
	boundaryFill(x, y+1, bColor, newColor);
	boundaryFill(x-1, y+1, bColor, newColor);
	boundaryFill(x-1, y, bColor, newColor);
	boundaryFill(x-1, y-1, bColor, newColor);
	boundaryFill(x, y-1, bColor, newColor);
	boundaryFill(x+1, y-1, bColor, newColor);
	boundaryFill(x+1, y, bColor, newColor);
	boundaryFill(x+1, y+1, bColor, newColor); 
	
    }*/

    
  return;
}

void boundaryfill(void){

    drawPolygon();
    
    struct Color fillColor = {0.0f, 0.0f, 1.0f}; //bluecolor
    struct Color boundaryColor = {0.0f, 0.0f, 0.0f}; //blackcolor
    //seedpixel 210,190
    boundaryFill(210, 190, boundaryColor, fillColor);


}

void Init()
{
/* Set clear color to white */
glClearColor(1.0,1.0,1.0,0);
/* Set fill color to black */
glColor3f(0.0,0.0,0.0);
/* glViewport(0 , 0 , 640 , 480); */
/* glMatrixMode(GL_PROJECTION); */
/* glLoadIdentity(); */
gluOrtho2D(0 , 640 , 0 , 480);
}
void main(int argc, char **argv)
{

/* Initialise GLUT library */
glutInit(&argc,argv);
/* Set the initial display mode */
glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
/* Set the initial window position and size */
glutInitWindowPosition(0,0);
glutInitWindowSize(640,480);
/* Create the window with title "DDA_Line" */
glutCreateWindow("DDA_Line");
/* Initialize drawing colors */
Init();
/* Call the displaying function */
glutDisplayFunc(boundaryfill);
/* Keep displaying untill the program is closed */
glutMainLoop();
}
