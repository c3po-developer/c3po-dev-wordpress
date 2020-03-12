# Documentación a añadir

elements.less
.gradient(#F5F5F5, #EEE, #FFF); Gradient background. First color is the background color to use for browsers that don't support gradients. The second two colors are the start and stop colors, going from bottom to top.
.bw-gradient(#EEE, 230, 255); Greyscale gradient background. Three values to set here. First one provides a color to use as a background for older browsers that don't support gradient backgrounds. Second and third values are the start and end brightness which goes from 0 to 255.
.bordered(#EEE, #E5E5E5, #DDD, #E5E5E5); Quick way to set a 1 pixel thick border that varies its color on each side. The color values go in a clockwise order: top, right, bottom, left.
.drop-shadow(0, 1px, 2px, 0.2); Adds a box-shadow that is a semi-transparent black. The first two values control the x and y axis position, the third controls blur (how big the shadow is), and the final value is the opacity (0 is fully transparent, 1 is opaque).
.rounded(5px); Sets a border-radius for all 4 corners. If you want to set border-radius for individual corners use: .border-radius
.border-radius(5px, 0, 0, 5px); Sets a border-radius for each of the 4 corners individually. The values go in a clockwise rotation: top right, bottom right, bottom left, top left.
.opacity(0.8); Sets the opacity. 0 is fully transparent, 1 is opaque.
.transition-duration(0.2s); Sets a transition-duration (time it takes to do things like hover effects). The value provides a time in seconds.
.rotation(15deg); Rotates the item by a number of degrees clockwise.
.scale(2); Scales the item by the ratio provided. The example makes the item 2 times larger.
.transition(2s, ease-out); Sets the transition duration and effect to use for any transitions (e.g. hover effects), unlike transition-duration which only sets the duration.
.inner-shadow(0, 1px, 2px, 0.4); Sets the inner shadow. The first two numbers are the x and y coordinates, the third is the blur and the last one is the strength of the shadow.
.box-shadow(0 1px 2px #999); Sets the box-shadow. The first two numbers are the x and y coordinates, then the blur, and the color. This is different from drop-shadow in that it takes on a color instead of setting a transparent black shadow. Additionally, this mixin takes on the whole set of arguments in one go, so no need for commas between each number, and you can also add "inset" before the first number for inset shadow.
.columns(250px, 0, 50px, #EEE, solid, 1px); Divides the content into columns. The variables are: column width, column count, column gap, column border color, column border style, column border width.
.translate(10px, 20px); Translates an element using the given coordinates. The values are x and y offset coordinates, so the above example moves the element right 10 pixels and up 20 pixels.
.box-sizing(content-box); Allows you to alter the CSS box model. For example, by setting this to 'border-box' the width and height properties will include the padding and border values. More info at MDN.
.user-select(none); Allows you to disable text highlighting, which can be useful on interface elements.

balloon css
Drawbacks
Balloon.css make use of pseudo-elements thus self-closing elements such as <img>, <input> and <hr> will not render tooltips.

Also keep in mind that if pseudo elements are already in use on an element, the tooltip will conflict with them resulting in potential bugs.

Positioning
<button aria-label="Whats up!" data-balloon-pos="up">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="left">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="right">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="down">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="up-left">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="up-right">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="down-left">Hover me!</button>
<button aria-label="Whats up!" data-balloon-pos="down-right">Hover me!</button>

Length
<button data-balloon-length="small" aria-label="Hi." data-balloon-pos="up">Hover me!</button>
<button data-balloon-length="medium" aria-label="Now that's a super big text we have over here right? Lorem ipsum dolor sit I'm done." data-balloon-pos="up">I'm a medium tooltip.</button>
<button data-balloon-length="large" aria-label="What about something really big? This may surpass your window dimensions. Imagine you're on that boring class with that boring teacher and you didn't slept so well last night. Suddenly you're sleeping in class. Can you believe it?!" data-balloon-pos="up">I'm a large tooltip</button>
<button data-balloon-length="xlarge" aria-label="What about something really big? This may surpass your window dimensions. Imagine you're on that boring class with that boring teacher and you didn't slept so well last night. Suddenly you're sleeping in class. Can you believe it?!" data-balloon-pos="up">I'm a Xlarge tooltip</button> 
<button data-balloon-length="fit" aria-label="What about something really big? This may surpass your window dimensions. Imagine you're on that boring class with that boring teacher and you didn't slept so well last night. Suddenly you're sleeping in class. Can you believe it?!" data-balloon-pos="up">My width will fit to element</button>

Disabling animation
<button data-balloon-blunt aria-label="No animation!" data-balloon-pos="up">No animation!</button>

Showing tooltips programatically
<button data-balloon-visible aria-label="I am always visible!" data-balloon-pos="up">Always visible!</button>

Customizing Tooltips
Balloon.css exposes three CSS variables to make it easier to customize tooltips: --balloon-color, --balloon-font-size and --balloon-move. This way you can use custom CSS to make your own tooltip styles:

```css
/* Add this to your CSS */
.tooltip-red {
  --balloon-color: red;
}

.tooltip-big-text {
  --balloon-font-size: 20px;
}

.tooltip-slide {
  --balloon-move: 30px;
}
```
<button aria-label="I am red!" class="tooltip-red">I am red!</button>
<button aria-label="I have big text!" class="tooltip-big-text">I have big text!</button>
<button aria-label="I move a lot!" class="tooltip-slide">I move a lot!</button>

```css
/* All tooltips would now be blue */
:root {
  --balloon-color: blue;
}
```

Glyphs and Icon Fonts
<button aria-label="HTML special characters: &#9787; &#9986; &#9820;" data-balloon-pos="up">Hover me!</button>
<button aria-label="Emojis: 😀 😬 😁 😂 😃 😄 😅 😆" data-balloon-pos="up">Hover me!</button>
<button class="font-awesome" aria-label="Font Awesome: &#xf030; &#xf133; &#xf1fc; &#xf03e; &#xf1f8;" data-balloon-pos="up">Hover me!</button>


Activar visual debug : url.com/?debug