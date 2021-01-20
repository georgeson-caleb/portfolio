var iBorder = 0;
var iColor = 0;
var iSize = 0;
var iFonts = 0;
var iPadding = 0;

function changeBorder() {
   var borders = ["2px solid black", 
                  "5px dotted red", 
                  "10px ridge blue", 
                  "1px dashed grey", 
                  "4px double #ffea32", 
                  "20px inset yellow"];

   var selection = iBorder % borders.length;

   document.getElementById("example").style.border = borders[selection];

   iBorder++;
}

function changeColor() {
   var colors = ["yellow",
                 "blue",
                 "grey",
                 "#edeb53",
                 "#9d93d9",
                 "#3ac7a4",
                 "#c79797"];
   
   var selection = iColor % colors.length;

   document.getElementById("example").style.backgroundColor = colors[selection];

   iColor++;
}

function changeSize() {
   var wSizes = ["200px", 
                 "900px", 
                 "600px", 
                 "300px",
                 "450px",
                 "700px"]
   var lSizes = ["300px",
                 "200px",
                 "900px",
                 "175px",
                 "730px",
                 "1200px",
                 "950px",
                 "850px"]
   
   var wSelection = iSize % wSizes.length;
   var lSelection = iSize % lSizes.length;

   console.log("wSelection: " + wSelection);
   console.log("lSelection: " + lSelection);


   document.getElementById("example").style.width = wSizes[wSelection];
   document.getElementById("example").style.height = lSizes[lSelection];

   iSize++;
}

function changeFont() {
   var fonts = ["Arial",
                "Lucida",
                "fantasy",
                "Consolas",
                "Times New Roman",
                "Comic Sans MS",
                "Impact",
                "Charcoal"]
   
   var select = iFonts % fonts.length;

   document.getElementById("example").style.fontFamily = fonts[select];

   iFonts++;
}

function changePadding() {
   var padding = ["20px",
                  "5px",
                  "25px",
                  "10px",
                  "40px"]
   
   var select = iPadding % padding.length;

   document.getElementById("example").style.padding = padding[select];

   iPadding++;
}

function changeRandomly() {
   iBorder = Math.floor(Math.random() * 20);
   iColor = Math.floor(Math.random() * 20);
   iSize = Math.floor(Math.random() * 20);
   iFonts = Math.floor(Math.random() * 20);
   iPadding = Math.floor(Math.random() * 20)

   
   changeBorder();
   changeColor();
   changeSize();
   changeFont();
   changePadding();
}