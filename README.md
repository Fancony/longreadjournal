The Longread Journal
===
![screenshot](screenshot.png)
===

#### Current state: Version 1.01
In development and the theme will undergo many internal changes. I will not change the frontend layout or short codes.

### Wordpress Install And Use Instructions
- Download the file
- Upload to server and install the theme
- When installed set up the menus
  There are two menu positions in the theme: one in the push/reveal sidebare and one on the frontpage

##### Shortcodes
- [quote] ... [/quote]
  - Creates a quote slightly breaking the column with red vertical line to draw attention.
- [big-image type="INSERT-TYPE"] IMAGE-URL [/big-image]
  - The type can be either SCROLL or FIXED. Image will break if no type is specified. FIXED reverts to SCROLL on mobile devices
- [review rating="NUMBER 1-10" header="REVIEW HEADER"]REVIEW SUM UP OR STATEMENT[/review]
  - Auto generates a color from green to red depending on the rating.
- [info-box bgcolor="HTML COLOR CODE" header="HEADER"]Contents[/info-box]
  - Creates a box of your choice of color. Great for creating an info box in the content. Could also be used to draw attention to other articles etc.
- [full-box bgcolor="HTML COLOR CODE" header="HEADER"]Contents[/full-box]
  - Same as the info-box only this is full width and works great as a divider or breeak in the content. Example use could be to use big-image short code immediately after this short code to create a cool 'chapter break' in the article.

A lot more Shortcodes in the works..

The theme has no comment template installed and the code comes with DISQUS coded directly into the theme. Go to discus and sign up. Insert your username in the code to make it load. You can also insert facebook comments into the same area, but not through plugins.

Contact me at @jfanc if you have any questions.
