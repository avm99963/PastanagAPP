import image_slicer
import sys
import os

# Source directory is stated at argument
directory = sys.argv[1]

for filename in os.listdir(directory):
    if filename.endswith(".jpg") or filename.endswith(".png"): 
		# Split image and save to variable
		without_ext = os.path.splitext(filename)[0]
		tiles = image_slicer.slice(directory + '/' + filename, 9, save=False)
		
		# Create directory for user
		newdirectory = './imgs/' + without_ext
		if not os.path.exists(newdirectory):
			os.makedirs(newdirectory)
		
		# Save tiles to new directory
		image_slicer.save_tiles(tiles, directory=newdirectory, prefix='slice', format='png')
    else:
        continue
