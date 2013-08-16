relative_assets = true

# Set this to the root of your project when deployed:
http_path = "/"
sass_dir = "public/sass"

path_prefix = "public"

css_dir = "assets/stylesheets/compiled"
css_path = path_prefix + "/" + css_dir

images_dir = "public/assets/images"
images_path = path_prefix + "/assets/images"
http_images_path = http_path + "/assets/images"

javascripts_dir = "assets/scripts"
javascripts_path = path_prefix + javascripts_dir

fonts_dir = "assets/fonts"
fonts_path = path_prefix + "/" + fonts_dir

generated_images_dir = images_dir + '/generated'
generated_images_path = path_prefix + "/assets/images/generated"
http_generated_images_path = http_path + "/assets/images/generated"

sprite_load_path = ["public/assets/images",  'public/assets/images/sprites']

sass_options = (environment == :production) ? { :quiet => true } : { :debug_info => true }
disable_warnings = (environment == :production) ? true : false 

extentions_dir = 'vendor'

add_import_path sass_dir + "/imports"

# Require any additional compass plugins here.
require 'compass_twitter_bootstrap'
require 'compass-normalize'
