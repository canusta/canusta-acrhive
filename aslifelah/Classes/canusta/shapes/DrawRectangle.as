/**
* ...
* @author Can Usta
*/

package canusta.shapes 
{
	
     import flash.display.*;  
	 
     public class DrawRectangle extends Sprite  
     {  
		 
		 private var xPos:Number;  
		 private var yPos:Number;  
		 private var rWidth:Number;  
		 private var rHeight:Number;  
		 private var color:uint;  
		 
         public function DrawRectangle(xPos:Number,yPos:Number,rWidth:Number,rHeight:Number,color:uint=0x000)  
        {  
            this.graphics.beginFill(color);  
            this.graphics.drawRect(xPos,yPos,rWidth,rHeight);  
            this.graphics.endFill();  
		}  
	}  
}  