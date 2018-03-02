<?php
Class resizer
		{
			// *** Class variables
                    private $image;
		    private $width;
		    private $height;
                    private $imageResized;
                    private $trgwidth;
                    private $trgheight;
                    private $trgpath;
                    private $type;
                    private $tmpfile;

			function __construct($file,$quality=100)
			{
				// *** Open up the file $width,$height,$path,$option="crop",
                            $this->tmpfile=$file['tmp_name'];
                            $this->type = $file["type"];
                            $this->image = $this->openImage();

			    list($this->width,$this->height) =getimagesize($file['tmp_name']) ;
                            
			   
                            
                            
			}

			## --------------------------------------------------------

			private function openImage()
			{
				// *** Get extension
				

				switch($this->type)
				{
                                        case 'image/jpeg':
					case 'image/pjpeg':
						$img = @imagecreatefromjpeg($this->tmpfile);
						break;
					case 'image/gif':
						$img = @imagecreatefromgif($this->tmpfile);
						break;
					case 'image/png':
						$img = @imagecreatefrompng($this->tmpfile);
						break;
					default:
						$img = false;
						break;
				}
				return $img;
			}

			## --------------------------------------------------------

			public function resizeImage($newWidth, $newHeight,$savePath, $imageQuality="100", $option="crop")
			{
				// *** Get optimal width and height - based on $option
				$optionArray = $this->getDimensions($newWidth, $newHeight, $option);

				$optimalWidth  = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];


				// *** Resample - create image canvas of x, y size
				
				// $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
				// imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
				$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
				 imagealphablending($this->imageResized, false);
				 imagesavealpha($this->imageResized,true);
				 $transparent = imagecolorallocatealpha($this->imageResized, 255, 255, 255, 127);
				 imagefilledrectangle($this->imageResized, 0, 0, $optimalWidth, $optimalWidth, $transparent);
				 imagecopyresampled($this->imageResized, $this->image,0, 0, 0, 0,$optimalWidth, $optimalHeight, $this->width, $this->height);
				switch($this->type)
				{
                    case 'image/jpeg':
					case 'image/pjpeg':
						$img = @imagecreatefromjpeg($this->tmpfile);
						break;
					case 'image/gif':
						$img = @imagecreatefromgif($this->tmpfile);
						break;
					case 'image/png':
						
						break;
					default:
						$img = false;
						break;
				}


				// *** if option is 'crop', then crop too
				if ($option == 'crop') {
					$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
				}
                                
                                //SAVE STARTS
                                
				// *** Get extension
        		
				switch($this->type)
				{
                                        case 'image/jpeg':
					case 'image/pjpeg':
						if (imagetypes() & IMG_JPG) {
							imagejpeg($this->imageResized, $savePath, $imageQuality);
						}
						break;

					case 'image/gif':
						if (imagetypes() & IMG_GIF) {
							imagegif($this->imageResized, $savePath);
						}
						break;

					case 'image/png':
                                       
						// *** Scale quality from 0-100 to 0-9
						$scaleQuality = round(($imageQuality/100) * 9);

						// *** Invert quality setting as 0 is best, not 9
						$invertScaleQuality = 9 - $scaleQuality;
							imagepng(  $this->imageResized, $savePath, 9 );
						if (imagetypes() & IMG_PNG) {
							imagepng(  $this->imageResized, $savePath, 9 );
							 //imagepng($this->imageResized, $savePath, $invertScaleQuality);
						}
						break;

					// ... etc

					default:
						// *** No extension - No save.
						break;
				}

				imagedestroy($this->imageResized);
                                return true;
			}

			## --------------------------------------------------------
			
			private function getDimensions($newWidth, $newHeight, $option)
			{

			   switch ($option)
				{
					case 'exact':
						$optimalWidth = $newWidth;
						$optimalHeight= $newHeight;
						break;
					case 'portrait':
						$optimalWidth = $this->getSizeByFixedHeight($newHeight);
						$optimalHeight= $newHeight;
						break;
					case 'landscape':
						$optimalWidth = $newWidth;
						$optimalHeight= $this->getSizeByFixedWidth($newWidth);
						break;
					case 'auto':
						$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
						$optimalWidth = $optionArray['optimalWidth'];
						$optimalHeight = $optionArray['optimalHeight'];
						break;
					case 'crop':
						$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
						$optimalWidth = $optionArray['optimalWidth'];
						$optimalHeight = $optionArray['optimalHeight'];
						break;
				}
				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function getSizeByFixedHeight($newHeight)
			{
				$ratio = $this->width / $this->height;
				$newWidth = $newHeight * $ratio;
				return $newWidth;
			}

			private function getSizeByFixedWidth($newWidth)
			{
				$ratio = $this->height / $this->width;
				$newHeight = $newWidth * $ratio;
				return $newHeight;
			}

			private function getSizeByAuto($newWidth, $newHeight)
			{
				if ($this->height < $this->width)
				// *** Image to be resized is wider (landscape)
				{
					$optimalWidth = $newWidth;
					$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				}
				elseif ($this->height > $this->width)
				// *** Image to be resized is taller (portrait)
				{
					$optimalWidth = $this->getSizeByFixedHeight($newHeight);
					$optimalHeight= $newHeight;
				}
				else
				// *** Image to be resizerd is a square
				{
					if ($newHeight < $newWidth) {
						$optimalWidth = $newWidth;
						$optimalHeight= $this->getSizeByFixedWidth($newWidth);
					} else if ($newHeight > $newWidth) {
						$optimalWidth = $this->getSizeByFixedHeight($newHeight);
						$optimalHeight= $newHeight;
					} else {
						// *** Sqaure being resized to a square
						$optimalWidth = $newWidth;
						$optimalHeight= $newHeight;
					}
				}

				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function getOptimalCrop($newWidth, $newHeight)
			{

				$heightRatio = $this->height / $newHeight;
				$widthRatio  = $this->width /  $newWidth;

				if ($heightRatio < $widthRatio) {
					$optimalRatio = $heightRatio;
				} else {
					$optimalRatio = $widthRatio;
				}

				$optimalHeight = $this->height / $optimalRatio;
				$optimalWidth  = $this->width  / $optimalRatio;

				return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
			}

			## --------------------------------------------------------

			private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
			{
				// *** Find center - this will be used for the crop
				$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
				$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

				$crop = $this->imageResized;
				//imagedestroy($this->imageResized);

				// *** Now crop from center to exact requested size
				//$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
				//imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);

				$this->imageResized = imagecreatetruecolor($newWidth, $newHeight);
				 imagealphablending($this->imageResized, false);
				 imagesavealpha($this->imageResized,true);
				 $transparent = imagecolorallocatealpha($this->imageResized, 255, 255, 255, 127);
				 imagefilledrectangle($this->imageResized, 0, 0, $newWidth, $newHeight, $transparent);
				 imagecopyresampled($this->imageResized, $crop,0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
				
			}

			## --------------------------------------------------------

			private function saveImage($savePath, $imageQuality="100")
			{
			}


			## --------------------------------------------------------

		}
