# Overivew
You're building a Jigsaw static site, styled with tailwind, templated with blade. You have successfully set up your site to work on Netlify. You've setup a develop branch so that you can preview deploys before committing and burning credits. 

Current problem:
## `main.blade.php` is not rendering the main `index.blade.php` correctly.
When I click into a post the CSS works great. But when I go back to the main / index the style goes away. Specifically the dynamic theme funciton I built no longer works. Take a look at how main.blade.php calls in the and how index.blade.php works vs. how post.blade.php works:



GHOST TO MARKDOWN CONVERSION SUMMARY
=====================================

Successfully converted 41 published posts from your Ghost export.

WHAT WAS CONVERTED:
- Only published posts (status='published')
- Skipped pages and drafts
- HTML content converted to Markdown
- All frontmatter fields mapped according to your template

FRONTMATTER STRUCTURE:
Each .md file includes:
- extends: _layouts.post
- section: content
- title: Post title (properly quoted)
- subtitle: (left empty)
- date: Publication date (YYYY-MM-DD format)
- description: Custom excerpt from Ghost (properly quoted)
- categories: Tags from Ghost (lowercase)
- cover-image: "assets/img/a-huge-dweeb.jpeg"
- featured: true/false

FIXES APPLIED:
✓ All description fields are now properly quoted (fixes YAML parsing errors)
✓ All __GHOST_URL__ placeholders replaced with: assets/img/a-huge-dweeb.jpeg
✓ Special characters (like colons) in descriptions are now escaped
✓ All YAML frontmatter is now valid and should parse correctly

FILES CREATED: 41 markdown files

READY TO USE:
These files should now work with Jigsaw without YAML parsing errors.
