jQuery(document).ready(function ($) {
  "use strict";

  var fonts_list = [{
    "name": "ABeeZee",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Abel",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Abhaya Libre",
    "subsets": ["latin-ext", "sinhala", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700", "800"]}]
  }, {
    "name": "Abril Fatface",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Aclonica", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Acme",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Actor", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Adamina",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Advent Pro",
    "subsets": ["latin-ext", "latin", "greek"],
    "variants": [{"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700"]}]
  }, {
    "name": "Aguafina Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Akronim",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Aladin",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Aldrich", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Alef",
    "subsets": ["latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Alegreya",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700", "900"]}, {
      "style": "normal",
      "weight": ["400", "700", "900"]
    }]
  }, {
    "name": "Alegreya SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700", "900"]}, {
      "style": "normal",
      "weight": ["400", "700", "900"]
    }]
  }, {
    "name": "Alegreya Sans",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "500", "700", "800", "900"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "500", "700", "800", "900"]
    }]
  }, {
    "name": "Alegreya Sans SC",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "500", "700", "800", "900"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "500", "700", "800", "900"]
    }]
  }, {
    "name": "Alex Brush",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Alfa Slab One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Alice", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Alike",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Alike Angular",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Allan",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Allerta",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Allerta Stencil",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Allura",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Almendra",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Almendra Display",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Almendra SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Amarante",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Amaranth",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Amatic SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Amatica SC",
    "subsets": ["latin-ext", "latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Amethysta",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Amiko",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "600", "700"]}]
  }, {
    "name": "Amiri",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Amita",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Anaheim",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Andada",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Andika",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Angkor",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Annie Use Your Telescope",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Anonymous Pro",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Antic",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Antic Didone",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Antic Slab",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Anton",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Arapey",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Arbutus",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Arbutus Slab",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Architects Daughter",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Archivo Black",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Archivo Narrow",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Aref Ruqaa",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Arima Madurai",
    "subsets": ["latin-ext", "latin", "vietnamese", "tamil"],
    "variants": [{"style": "normal", "weight": ["100", "200", "300", "400", "500", "700", "800", "900"]}]
  }, {
    "name": "Arimo",
    "subsets": ["latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Arizonia",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Armata",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Artifika", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Arvo",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Arya",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Asap",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "500", "700"]}, {
      "style": "normal",
      "weight": ["400", "500", "700"]
    }]
  }, {
    "name": "Asar",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Asset",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Assistant",
    "subsets": ["latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "600", "700", "800"]}]
  }, {
    "name": "Astloch",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Asul",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Athiti",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700"]}]
  }, {
    "name": "Atma",
    "subsets": ["latin-ext", "latin", "bengali"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Atomic Age",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Aubrey",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Audiowide",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Autour One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Average",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Average Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Averia Gruesa Libre",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Averia Libre",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "700"]
    }]
  }, {
    "name": "Averia Sans Libre",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "700"]
    }]
  }, {
    "name": "Averia Serif Libre",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "700"]
    }]
  }, {
    "name": "Bad Script",
    "subsets": ["latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo",
    "subsets": ["latin-ext", "latin", "vietnamese", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Bhai",
    "subsets": ["latin-ext", "latin", "gujarati", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Bhaina",
    "subsets": ["latin-ext", "latin", "vietnamese", "oriya"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Chettan",
    "subsets": ["latin-ext", "latin", "malayalam", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Da",
    "subsets": ["latin-ext", "latin", "vietnamese", "bengali"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Paaji",
    "subsets": ["latin-ext", "latin", "vietnamese", "gurmukhi"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Tamma",
    "subsets": ["latin-ext", "latin", "kannada", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Baloo Thambi",
    "subsets": ["latin-ext", "latin", "vietnamese", "tamil"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Balthazar",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Bangers", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Basic",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Battambang",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Baumans", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Bayon",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Belgrano",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Belleza",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "BenchNine",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Bentham",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Berkshire Swash",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bevan",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bigelow Rules",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bigshot One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bilbo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bilbo Swash Caps",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "BioRhyme",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "700", "800"]}]
  }, {
    "name": "BioRhyme Expanded",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "700", "800"]}]
  }, {
    "name": "Biryani",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "600", "700", "800", "900"]}]
  }, {
    "name": "Bitter",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Black Ops One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Bokor", "subsets": ["khmer"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Bonbon",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Boogaloo",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bowlby One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bowlby One SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Brawler",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bree Serif",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bubblegum Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bubbler One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Buda", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["300"]}]}, {
    "name": "Buenard",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Bungee",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bungee Hairline",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bungee Inline",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bungee Outline",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Bungee Shade",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Butcherman",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Butterfly Kids",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cabin",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "500", "600", "700"]}, {
      "style": "normal",
      "weight": ["400", "500", "600", "700"]
    }]
  }, {
    "name": "Cabin Condensed",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700"]}]
  }, {
    "name": "Cabin Sketch",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Caesar Dressing",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cagliostro",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cairo",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "600", "700", "900"]}]
  }, {
    "name": "Calligraffitti",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cambay",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Cambo", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Candal",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cantarell",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Cantata One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cantora One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Capriola",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cardo",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Carme",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Carrois Gothic",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Carrois Gothic SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Carter One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Catamaran",
    "subsets": ["latin-ext", "latin", "tamil"],
    "variants": [{"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Caudex",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Caveat",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Caveat Brush",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cedarville Cursive",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ceviche One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Changa",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700", "800"]}]
  }, {
    "name": "Changa One",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chango",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chathura",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["100", "300", "400", "700", "800"]}]
  }, {
    "name": "Chau Philomene One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chela One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chelsea Market",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chenla",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cherry Cream Soda",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cherry Swash",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Chewy", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Chicle",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Chivo",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "900"]}, {"style": "normal", "weight": ["400", "900"]}]
  }, {
    "name": "Chonburi",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cinzel",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700", "900"]}]
  }, {
    "name": "Cinzel Decorative",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700", "900"]}]
  }, {
    "name": "Clicker Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Coda",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "800"]}]
  }, {
    "name": "Coda Caption",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["800"]}]
  }, {
    "name": "Codystar",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400"]}]
  }, {
    "name": "Coiny",
    "subsets": ["latin-ext", "latin", "vietnamese", "tamil"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Combo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Comfortaa",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Coming Soon",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Concert One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Condiment",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Content",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Contrail One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Convergence",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Cookie", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Copse",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Corben",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Cormorant",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "600", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "600", "700"]
    }]
  }, {
    "name": "Cormorant Garamond",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "600", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "600", "700"]
    }]
  }, {
    "name": "Cormorant Infant",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "600", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "600", "700"]
    }]
  }, {
    "name": "Cormorant SC",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Cormorant Unicase",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Cormorant Upright",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Courgette",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cousine",
    "subsets": ["latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Coustard",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "900"]}]
  }, {
    "name": "Covered By Your Grace",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Crafty Girls",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Creepster",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Crete Round",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Crimson Text",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "600", "700"]}, {
      "style": "normal",
      "weight": ["400", "600", "700"]
    }]
  }, {
    "name": "Croissant One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Crushed", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Cuprum",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Cutive",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Cutive Mono",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Damion",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Dancing Script",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Dangrek",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "David Libre",
    "subsets": ["latin-ext", "latin", "hebrew", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400", "500", "700"]}]
  }, {
    "name": "Dawning of a New Day",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Days One", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Dekko",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Delius",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Delius Swash Caps",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Delius Unicase",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Della Respira",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Denk One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Devonshire",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Dhurjati",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Didact Gothic",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Diplomata",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Diplomata SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Domine",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Donegal One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Doppio One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Dorsa", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Dosis",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700", "800"]}]
  }, {
    "name": "Dr Sugiyama",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Droid Sans",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Droid Sans Mono",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Droid Serif",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Duru Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Dynalight",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "EB Garamond",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Eagle Lake",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Eater",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Economica",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Eczar",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700", "800"]}]
  }, {
    "name": "Ek Mukta",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700", "800"]}]
  }, {
    "name": "El Messiri",
    "subsets": ["arabic", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700"]}]
  }, {
    "name": "Electrolize",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Elsie",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "900"]}]
  }, {
    "name": "Elsie Swash Caps",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "900"]}]
  }, {
    "name": "Emblema One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Emilys Candy",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Engagement",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Englebert",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Enriqueta",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Erica One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Esteban",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Euphoria Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ewert",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Exo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Exo 2",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Expletus Sans",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "500", "600", "700"]}, {
      "style": "normal",
      "weight": ["400", "500", "600", "700"]
    }]
  }, {
    "name": "Fanwood Text",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Farsan",
    "subsets": ["latin-ext", "latin", "gujarati", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fascinate",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fascinate Inline",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Faster One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fasthand",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fauna One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Federant",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Federo", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Felipa",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fenix",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Finger Paint",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fira Mono",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Fira Sans",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "700"]
    }]
  }, {
    "name": "Fjalla One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fjord One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Flamenco",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["300", "400"]}]
  }, {
    "name": "Flavors",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fondamento",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fontdiner Swanky",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Forum",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Francois One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Frank Ruhl Libre",
    "subsets": ["latin-ext", "latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "700", "900"]}]
  }, {
    "name": "Freckle Face",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fredericka the Great",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fredoka One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Freehand",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fresca",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Frijole",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fruktur",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Fugaz One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "GFS Didot",
    "subsets": ["greek"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "GFS Neohellenic",
    "subsets": ["greek"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Gabriela",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gafata",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Galada",
    "subsets": ["latin", "bengali"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Galdeano",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Galindo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gentium Basic",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Gentium Book Basic",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Geo",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Geostar",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Geostar Fill",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Germania One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gidugu",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gilda Display",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Give You Glory",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Glass Antiqua",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Glegoo",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Gloria Hallelujah",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Goblin One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gochi Hand",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gorditas",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Goudy Bookletter 1911",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Graduate",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Grand Hotel",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gravitas One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Great Vibes",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Griffy",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gruppo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Gudea",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Gurajada",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Habibi",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Halant",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Hammersmith One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Hanalei",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Hanalei Fill",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Handlee",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Hanuman",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Happy Monkey",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Harmattan",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Headland One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Heebo",
    "subsets": ["latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["100", "300", "400", "500", "700", "800", "900"]}]
  }, {
    "name": "Henny Penny",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Herr Von Muellerhoff",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Hind",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Hind Guntur",
    "subsets": ["latin-ext", "telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Hind Madurai",
    "subsets": ["latin-ext", "latin", "tamil"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Hind Siliguri",
    "subsets": ["latin-ext", "latin", "bengali"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Hind Vadodara",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Holtwood One SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Homemade Apple",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Homenaje",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell DW Pica",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell DW Pica SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell Double Pica",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell Double Pica SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell English",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell English SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell French Canon",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell French Canon SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell Great Primer",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "IM Fell Great Primer SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Iceberg",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Iceland",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Imprima",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Inconsolata",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Inder",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Indie Flower",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Inika",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Inknut Antiqua",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Irish Grover",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Istok Web",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Italiana",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Italianno",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Itim",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jacques Francois",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jacques Francois Shadow",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jaldi",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Jim Nightshade",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jockey One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jolly Lodger",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Jomhuria",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Josefin Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "600", "700"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "600", "700"]
    }]
  }, {
    "name": "Josefin Slab",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "600", "700"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "600", "700"]
    }]
  }, {
    "name": "Joti One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Judson",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Julee",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Julius Sans One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Junge", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Jura",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600"]}]
  }, {
    "name": "Just Another Hand",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Just Me Again Down Here",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kadwa",
    "subsets": ["latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Kalam",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Kameron",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Kanit",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Kantumruy",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Karla",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Karma",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Katibeh",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kaushan Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kavivanar",
    "subsets": ["latin-ext", "latin", "tamil"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kavoon",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kdam Thmor",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Keania One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kelly Slab",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Kenia", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Khand",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {"name": "Khmer", "subsets": ["khmer"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Khula",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "600", "700", "800"]}]
  }, {
    "name": "Kite One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Knewave",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kotta One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Koulen", "subsets": ["khmer"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Kranky",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kreon",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Kristi",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Krona One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kumar One",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kumar One Outline",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Kurale",
    "subsets": ["latin-ext", "latin", "cyrillic", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "La Belle Aurore",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Laila",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Lakki Reddy",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lalezar",
    "subsets": ["arabic", "latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lancelot",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lateef",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lato",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "700", "900"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "700", "900"]
    }]
  }, {
    "name": "League Script",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Leckerli One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ledger",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lekton",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Lemon", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Lemonada",
    "subsets": ["arabic", "latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["300", "400", "600", "700"]}]
  }, {
    "name": "Libre Baskerville",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Libre Franklin",
    "subsets": ["latin-ext", "latin"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Life Savers",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Lilita One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lily Script One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Limelight",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Linden Hill",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lobster",
    "subsets": ["latin-ext", "latin", "cyrillic", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lobster Two",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Londrina Outline",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Londrina Shadow",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Londrina Sketch",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Londrina Solid",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lora",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Love Ya Like A Sister",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Loved by the King",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lovers Quarrel",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Luckiest Guy",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Lusitana",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Lustria",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Macondo",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Macondo Swash Caps",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mada",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "900"]}]
  }, {
    "name": "Magra",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Maiden Orange",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Maitree",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700"]}]
  }, {"name": "Mako", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Mallanna",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mandali",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Marcellus",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Marcellus SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Marck Script",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Margarine",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Marko One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Marmelad",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Martel",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "600", "700", "800", "900"]}]
  }, {
    "name": "Martel Sans",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "600", "700", "800", "900"]}]
  }, {
    "name": "Marvel",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Mate",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mate SC",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Maven Pro",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "500", "700", "900"]}]
  }, {
    "name": "McLaren",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Meddon",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "MedievalSharp",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Medula One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Meera Inimai",
    "subsets": ["latin", "tamil"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Megrim",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Meie Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Merienda",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Merienda One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Merriweather",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700", "900"]}, {
      "style": "normal",
      "weight": ["300", "400", "700", "900"]
    }]
  }, {
    "name": "Merriweather Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700", "800"]}, {
      "style": "normal",
      "weight": ["300", "400", "700", "800"]
    }]
  }, {
    "name": "Metal",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Metal Mania",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Metamorphous",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Metrophobic",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Michroma",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Milonga",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Miltonian",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Miltonian Tattoo",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Miniver",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Miriam Libre",
    "subsets": ["latin-ext", "latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Mirza",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700"]}]
  }, {
    "name": "Miss Fajardose",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mitr",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700"]}]
  }, {
    "name": "Modak",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Modern Antiqua",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mogra",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Molengo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Molle",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}]
  }, {
    "name": "Monda",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Monofett",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Monoton",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Monsieur La Doulaise",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Montaga", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Montez",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Montserrat",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Montserrat Alternates",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Montserrat Subrayada",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Moul", "subsets": ["khmer"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Moulpali",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mountains of Christmas",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Mouse Memoirs",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mr Bedfort",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mr Dafoe",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mr De Haviland",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mrs Saint Delafield",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mrs Sheppards",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Mukta Vaani",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700", "800"]}]
  }, {
    "name": "Muli",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["200", "300", "400", "600", "700", "800", "900"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "600", "700", "800", "900"]
    }]
  }, {
    "name": "Mystery Quest",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "NTR",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Neucha",
    "subsets": ["latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Neuton",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "700", "800"]
    }]
  }, {
    "name": "New Rocker",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "News Cycle",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Niconne",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nixie One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nobile",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Nokora",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Norican",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nosifer",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nothing You Could Do",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Noticia Text",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Noto Sans",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese", "devanagari"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Noto Serif",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Nova Cut",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Flat",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Mono",
    "subsets": ["latin", "greek"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Oval",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Round",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Script",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Slim",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Nova Square",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Numans", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Nunito",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["200", "300", "400", "600", "700", "800", "900"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "600", "700", "800", "900"]
    }]
  }, {
    "name": "Nunito Sans",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["200", "300", "400", "600", "700", "800", "900"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "600", "700", "800", "900"]
    }]
  }, {
    "name": "Odor Mean Chey",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Offside",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Old Standard TT",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Oldenburg",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Oleo Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Oleo Script Swash Caps",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Open Sans",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300", "400", "600", "700", "800"]}, {
      "style": "normal",
      "weight": ["300", "400", "600", "700", "800"]
    }]
  }, {
    "name": "Open Sans Condensed",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300"]}, {"style": "normal", "weight": ["300", "700"]}]
  }, {
    "name": "Oranienbaum",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Orbitron",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "500", "700", "900"]}]
  }, {
    "name": "Oregano",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Orienta",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Original Surfer",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Oswald",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Over the Rainbow",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Overlock",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700", "900"]}, {
      "style": "normal",
      "weight": ["400", "700", "900"]
    }]
  }, {
    "name": "Overlock SC",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Ovo", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Oxygen",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "700"]}]
  }, {
    "name": "Oxygen Mono",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "PT Mono",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "PT Sans",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "PT Sans Caption",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "PT Sans Narrow",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "PT Serif",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "PT Serif Caption",
    "subsets": ["latin-ext", "latin", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pacifico",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Palanquin",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700"]}]
  }, {
    "name": "Palanquin Dark",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700"]}]
  }, {
    "name": "Paprika",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Parisienne",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Passero One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Passion One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700", "900"]}]
  }, {
    "name": "Pathway Gothic One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Patrick Hand",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Patrick Hand SC",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pattaya",
    "subsets": ["latin-ext", "latin", "thai", "cyrillic", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Patua One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pavanam",
    "subsets": ["latin-ext", "latin", "tamil"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Paytone One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Peddana",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Peralta",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Permanent Marker",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Petit Formal Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Petrona",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Philosopher",
    "subsets": ["latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Piedra",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pinyon Script",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pirata One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Plaster",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Play",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Playball",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Playfair Display",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700", "900"]}, {
      "style": "normal",
      "weight": ["400", "700", "900"]
    }]
  }, {
    "name": "Playfair Display SC",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700", "900"]}, {
      "style": "normal",
      "weight": ["400", "700", "900"]
    }]
  }, {
    "name": "Podkova",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Poiret One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Poller One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Poly",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pompiere",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pontano Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Poppins",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Port Lligat Sans",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Port Lligat Slab",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pragati Narrow",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Prata",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Preahvihear",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Press Start 2P",
    "subsets": ["latin-ext", "latin", "greek", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Pridi",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700"]}]
  }, {
    "name": "Princess Sofia",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Prociono",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Prompt",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Prosto One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Proza Libre",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "500", "600", "700", "800"]}, {
      "style": "normal",
      "weight": ["400", "500", "600", "700", "800"]
    }]
  }, {
    "name": "Puritan",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Purple Purse",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Quando",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Quantico",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Quattrocento",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Quattrocento Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Questrial",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Quicksand",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "700"]}]
  }, {
    "name": "Quintessential",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Qwigley",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Racing Sans One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Radley",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rajdhani",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Rakkas",
    "subsets": ["arabic", "latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Raleway",
    "subsets": ["latin-ext", "latin"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Raleway Dots",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ramabhadra",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ramaraja",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rambla",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Rammetto One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ranchers",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Rancho", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Ranga",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Rasa",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Rationale",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ravi Prakash",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Redressed",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Reem Kufi",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Reenie Beanie",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Revalia",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rhodium Libre",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ribeye",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ribeye Marrow",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Righteous",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Risque",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Roboto",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "500", "700", "900"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "500", "700", "900"]
    }]
  }, {
    "name": "Roboto Condensed",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["300", "400", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "700"]
    }]
  }, {
    "name": "Roboto Mono",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["100", "300", "400", "500", "700"]}, {
      "style": "normal",
      "weight": ["100", "300", "400", "500", "700"]
    }]
  }, {
    "name": "Roboto Slab",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["100", "300", "400", "700"]}]
  }, {
    "name": "Rochester",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rock Salt",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rokkitt",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Romanesco",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ropa Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rosario",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Rosarivo",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rouge Script",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rozha One",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rubik",
    "subsets": ["latin-ext", "latin", "hebrew", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "700", "900"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "700", "900"]
    }]
  }, {
    "name": "Rubik Mono One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rubik One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ruda",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700", "900"]}]
  }, {
    "name": "Rufina",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Ruge Boogie",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ruluko",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rum Raisin",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ruslan Display",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Russo One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ruthie",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Rye",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sacramento",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sahitya",
    "subsets": ["latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Sail",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Salsa", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Sanchez",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sancreek",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sansita One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sarala",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Sarina",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sarpanch",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700", "800", "900"]}]
  }, {"name": "Satisfy", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Scada",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Scheherazade",
    "subsets": ["arabic", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Schoolbell",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Scope One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Seaweed Script",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Secular One",
    "subsets": ["latin-ext", "latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sevillana",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Seymour One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Shadows Into Light",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Shadows Into Light Two",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Shanti", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Share",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Share Tech",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Share Tech Mono",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Shojumaru",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Short Stack",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Shrikhand",
    "subsets": ["latin-ext", "latin", "gujarati"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Siemreap",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sigmar One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Signika",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "600", "700"]}]
  }, {
    "name": "Signika Negative",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "600", "700"]}]
  }, {
    "name": "Simonetta",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400", "900"]}, {"style": "normal", "weight": ["400", "900"]}]
  }, {
    "name": "Sintony",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Sirin Stencil",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Six Caps",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Skranji",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Slabo 13px",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Slabo 27px",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Slackey", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Smokum",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {"name": "Smythe", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Sniglet",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "800"]}]
  }, {
    "name": "Snippet",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Snowburst One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sofadi One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sofia",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sonsie One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sorts Mill Goudy",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Source Code Pro",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "500", "600", "700", "900"]}]
  }, {
    "name": "Source Sans Pro",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["200", "300", "400", "600", "700", "900"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "600", "700", "900"]
    }]
  }, {
    "name": "Source Serif Pro",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400", "600", "700"]}]
  }, {
    "name": "Space Mono",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Special Elite",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Spicy Rice",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Spinnaker",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Spirax",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Squada One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sree Krushnadevaraya",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sriracha",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Stalemate",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Stalinist One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Stardos Stencil",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Stint Ultra Condensed",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Stint Ultra Expanded",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Stoke",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400"]}]
  }, {
    "name": "Strait",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sue Ellen Francisco",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Suez One",
    "subsets": ["latin-ext", "latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sumana",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Sunshiney",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Supermercado One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Sura",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Suranna",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Suravaram",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Suwannaphum",
    "subsets": ["khmer"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Swanky and Moo Moo",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Syncopate",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Tangerine",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Taprom", "subsets": ["khmer"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Tauri",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Taviraj",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Teko",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {
    "name": "Telex",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Tenali Ramakrishna",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Tenor Sans",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Text Me One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "The Girl Next Door",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Tienne",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700", "900"]}]
  }, {
    "name": "Tillana",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "500", "600", "700", "800"]}]
  }, {
    "name": "Timmana",
    "subsets": ["telugu", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Tinos",
    "subsets": ["latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Titan One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Titillium Web",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "italic", "weight": ["200", "300", "400", "600", "700"]}, {
      "style": "normal",
      "weight": ["200", "300", "400", "600", "700", "900"]
    }]
  }, {
    "name": "Trade Winds",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Trirong",
    "subsets": ["latin-ext", "latin", "thai", "vietnamese"],
    "variants": [{
      "style": "italic",
      "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]
    }, {"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Trocchi",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Trochut",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Trykker",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Tulpen One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ubuntu",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["300", "400", "500", "700"]}, {
      "style": "normal",
      "weight": ["300", "400", "500", "700"]
    }]
  }, {
    "name": "Ubuntu Condensed",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Ubuntu Mono",
    "subsets": ["latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Ultra",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Uncial Antiqua",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Underdog",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Unica One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "UnifrakturCook",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["700"]}]
  }, {
    "name": "UnifrakturMaguntia",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Unkempt",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400", "700"]}]
  }, {"name": "Unlock", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Unna",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "VT323",
    "subsets": ["latin-ext", "latin", "vietnamese"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Vampiro One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Varela",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Varela Round",
    "subsets": ["latin", "hebrew"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Vast Shadow",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Vesper Libre",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400", "500", "700", "900"]}]
  }, {"name": "Vibur", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}, {
    "name": "Vidaloka",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Viga",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Voces",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Volkhov",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Vollkorn",
    "subsets": ["latin"],
    "variants": [{"style": "italic", "weight": ["400", "700"]}, {"style": "normal", "weight": ["400", "700"]}]
  }, {
    "name": "Voltaire",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Waiting for the Sunrise",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Wallpoet",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Walter Turncoat",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Warnes",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Wellfleet",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Wendy One",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Wire One",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Work Sans",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["100", "200", "300", "400", "500", "600", "700", "800", "900"]}]
  }, {
    "name": "Yanone Kaffeesatz",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["200", "300", "400", "700"]}]
  }, {
    "name": "Yantramanav",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["100", "300", "400", "500", "700", "900"]}]
  }, {
    "name": "Yatra One",
    "subsets": ["latin-ext", "latin", "devanagari"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Yellowtail",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Yeseva One",
    "subsets": ["latin-ext", "latin", "cyrillic"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Yesteryear",
    "subsets": ["latin"],
    "variants": [{"style": "normal", "weight": ["400"]}]
  }, {
    "name": "Yrsa",
    "subsets": ["latin-ext", "latin"],
    "variants": [{"style": "normal", "weight": ["300", "400", "500", "600", "700"]}]
  }, {"name": "Zeyada", "subsets": ["latin"], "variants": [{"style": "normal", "weight": ["400"]}]}];


  // ------------------------------------------------------------
  $('.wd-color-picker').wpColorPicker(
      {format: 'rgba'}
  );

  

  //---------------logo script-----------
  jQuery('#doors_upload_btn').on('click',function () {
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_logo_filed').val(attachment.url);
      jQuery('#doors_logo_filed').click();
    }
    wp.media.editor.open(this);

    return false;
  });

  //---------------footer bg image script-----------
  jQuery('#doors_footer_bg_btn').on('click',function () {
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_footer_bg_filed').val(attachment.url);
      jQuery('#doors_footer_bg_filed').click();
    }
    wp.media.editor.open(this);

    return false;
  });
  //---------------bg home page-----------
  jQuery('#doors_bg_home_page').on('click',function () {
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_home_page_filed').val(attachment.url);
      jQuery('#doors_home_page_filed').click();
    }
    wp.media.editor.open(this);

    return false;
  });
  //---------------bg title bar blog page-----------
  jQuery('#doors_blog_title_bg_image').on('click',function () {
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_blog_title_bg_image_filed').val(attachment.url);
      jQuery('#doors_blog_title_bg_image_filed').click();
    }
    wp.media.editor.open(this);

    return false;
  });


  //------favicon script-----
  jQuery('#doors_upload_favicon').on('click',function () {
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_favicon_filed').val(attachment.url);
      jQuery('#doors_favicon_filed').click();
    }
    wp.media.editor.open(this);
    return false;
  });

  //------ Menu Background image -----
  jQuery('#doors_upload_btn_bg').on('click',function () {
    var that = this;
    wp.media.editor.send.attachment = function (props, attachment) {
      jQuery('#doors_menu_bg_img_filed').val(attachment.url);
      jQuery('#doors_menu_bg_img_filed').click();
    }
    wp.media.editor.open(this);
    return false;
  });


  jQuery('.img-container .remove-img').on('click',function () {
    jQuery(this).parent().parent().find('input[type="text"]').val('none');
    jQuery(this).parent().remove();
  });
  //-------------------------------------


  $('.option-item.big.tile select').on('change',function () {
    var optionSelected = $(this).find("option:selected");
    var valueSelected = optionSelected.val();

    if (valueSelected == 'big-custom_text') {
      $(this).parent().find('textarea').show();
    } else {
      $(this).parent().find('textarea').hide();
    }
  });
  /**--------logo --------*/
  $('.chekbox_logo').on('change',function () {
    if ($(this).attr("checked")) {

      $('.path_logo').fadeIn();
      return;
    }
    $('.path_logo').fadeOut();
  });
  /**--------social icon --------*/
  $('.checkbox_social').on('change',function () {
    if ($(this).attr("checked")) {

      $('.social_link').fadeIn();
      return;
    }
    $('.social_link').fadeOut();
  });

  var wd_font_family = "";
  var wd_font_weight = "";
  var wd_font_style = "";
  var wd_font_weight = "";
  var wd_font_subsets = "";
  var data_classes = "";
  var fonts_subsets = [];
  var fonts_variants = [];
  var fonts_weights = [];

  $("#tabs-2 select.font_familly").on('change',function () {
    wd_font_family = $(this).val();
    data_classes = $(this).data("classes");
    $("#tabs-2 .font_weight_list." + data_classes).find('option').remove();
    $("#tabs-2 select.font_weight." + data_classes).find('option').remove();
    $("#tabs-2 select.font_subsets." + data_classes).find('option').remove();
    $("#tabs-2 select.font_style." + data_classes).find('option').remove();
    if (wd_font_family == 'default') {
      for (var i = 100; i < 1000; i += 100) {
        $("#tabs-2 select.font_weight_list." + data_classes).append('<option value=' + i + '>' + font_weight_name(i.toString()) + '</option>');
        $("#tabs-2 select.font_weight." + data_classes).append('<option value=' + i + '>' + font_weight_name(i.toString()) + '</option>');
      }
      $("#tabs-2 select.font_subsets." + data_classes).append('<option value="default">Default</option>');
      $("#tabs-2 select.font_style." + data_classes).append('<option value="default">Default</option>');
      wd_font_family = 'Open Sans';
    } else {
      var found = false;
      for (var i = 0; i < fonts_list.length; i++) {
        if (wd_font_family == fonts_list[i]['name']) {
          fonts_subsets = fonts_list[i]['subsets'];
          fonts_variants = fonts_list[i]['variants'];
          fonts_weights = fonts_variants[0]['weight'];
          found = true;
          break;
        }
      }
      if (found == true) {
        for (var j = 0; j < fonts_subsets.length; j++) {
          $("#tabs-2 select.font_subsets." + data_classes).append('<option value="' + fonts_subsets[j] + '">' + fonts_subsets[j] + '</option>');
        }
        for (var j = 0; j < fonts_variants.length; j++) {
          var style_flag = '';
          var style_name = '';
          if (fonts_variants[j]['style'] == 'italic') {
            style_flag = 'i';
            style_name = ' Italic';
          } else {
            style_flag = '';
            style_name = '';
          }
          for (var k = 0; k < fonts_variants[0]['weight'].length; k++) {
            $("#tabs-2 .font_weight_list." + data_classes).append('<option value="' + fonts_variants[0]['weight'][k] + style_flag + '">' + font_weight_name(fonts_variants[0]['weight'][k]) + style_name + '</option>');
          }
        }
        for (var j = 0; j < fonts_variants.length; j++) {
          $("#tabs-2 select.font_style." + data_classes).append('<option value="' + fonts_variants[j]['style'] + '">' + fonts_variants[j]['style'] + '</option>');
        }
        for (var j = 0; j < fonts_weights.length; j++) {
          var fonts_name = font_weight_name(fonts_weights[j].toString());
          $("#tabs-2 select.font_weight." + data_classes).append('<option value="' + fonts_weights[j] + '">' + fonts_name + '</option>');
        }

      } else {
        for (var i = 100; i < 1000; i += 100) {
          $("#tabs-2 select.font_weight_list." + data_classes).append('<option value=' + i + '>' + font_weight_name(i.toString()) + '</option>');
          $("#tabs-2 select.font_weight." + data_classes).append('<option value=' + i + '>' + font_weight_name(i.toString()) + '</option>');
        }
        $("#tabs-2 select.font_subsets." + data_classes).append('<option value="default">Default</option>');
        $("#tabs-2 select.font_style." + data_classes).append('<option value="default">Default</option>');
      }
    }


    wd_font_weight = $("#tabs-2 select.font_weight." + data_classes).val();
    wd_font_style = $("#tabs-2 select.font_style." + data_classes).val();
    wd_font_subsets = $("#tabs-2 select.font_subsets." + data_classes).val();

    $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + wd_font_family + ":" + wd_font_weight + "&subset=" + wd_font_subsets);
    $("#tabs-2 .preview_result." + data_classes).css({
      "font-family": wd_font_family,
      "font-weight": wd_font_weight,
      "font-style": wd_font_style
    });
  });

  $("#tabs-2 select.font_weight").on('change',function () {
    data_classes = $(this).data("classes");
    wd_font_weight = $(this).val();
    wd_font_family = $("#tabs-2 select.font_familly." + data_classes).val();
    wd_font_style = $("#tabs-2 select.font_style." + data_classes).val();
    wd_font_subsets = $("#tabs-2 select.font_subsets." + data_classes).val();

    $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + wd_font_family + ":" + wd_font_weight + "&subset=" + wd_font_subsets);
    $("#tabs-2 .preview_result." + data_classes).css({
      "font-family": wd_font_family,
      "font-weight": wd_font_weight,
      "font-style": wd_font_style
    });
  });

  $("#tabs-2 select.font_style").on('change',function () {
    data_classes = $(this).data("classes");
    wd_font_style = $(this).val();
    wd_font_family = $("#tabs-2 select.font_familly." + data_classes).val();
    wd_font_weight = $("#tabs-2 select.font_style." + data_classes).val();
    wd_font_subsets = $("#tabs-2 select.font_subsets." + data_classes).val();

    $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + wd_font_family + ":" + wd_font_weight + "&subset=" + wd_font_subsets);
    $("#tabs-2 .preview_result." + data_classes).css({
      "font-family": wd_font_family,
      "font-weight": wd_font_weight,
      "font-style": wd_font_style
    });
  });

  $("#tabs-2 select.font_subsets").on('change',function () {
    data_classes = $(this).data("classes");
    wd_font_family = $("#tabs-2 select.font_familly." + data_classes).val();
    wd_font_weight = $("#tabs-2 select.font_weight." + data_classes).val();
    wd_font_subsets = $(this).val();
    $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + wd_font_family + ":" + wd_font_weight + "&subset=" + wd_font_subsets);
  });

  $('#tabs-2 input.fonts_size').bind("change keyup paste input select focusin focusout focus click", function () {
    data_classes = $(this).data("classes");
    var size = $(this).val();
    $("#tabs-2 .preview_result." + data_classes).css({"font-size": size});
  });

  $('#tabs-2 input.letter_spacing').bind("change keyup paste input select focusin focusout focus click", function () {
    data_classes = $(this).data("classes");
    var size = $(this).val();
    $("#tabs-2 .preview_result." + data_classes).css({"letter-spacing": size});
  });

  $(".bg_delete_button").on('click',function () {
    var data_classes = $(this).data("bgimage");
    $("." + data_classes + '_input').val('');
    $("." + data_classes + '_image').attr('src', '');
  });

  $('.bg_input_field').bind("change keyup paste input select focusin focusout focus click", function () {
    var data_classes = $(this).data("bgimage");
    $("." + data_classes + '_image').attr('src', $(this).val());
  });

  $('.doors_footer_columns').bind("change click", function () {
    var label = $(this).val();
    $('.doors_footer_columns_label').removeClass('label_selected ');
    $('.' + label).addClass('label_selected ');
  });


  $('ul.g_tab li').on('click',function(){
    var tab_id = $(this).attr('data-tab');
    var fromParent = $(this).closest('.groups_tabs');
    console.log(fromParent);
    $('ul.g_tab li', fromParent).removeClass('current');
    $('.tab-content', fromParent).removeClass('current');
    $(this).addClass('current');
    $("#"+tab_id, fromParent).addClass('current');
  });

  /*--------------------------------------*/
  var curent_sreen = '';

  function doors_add_ckeckbox_class() {
    curent_sreen = $("input:radio[name='doors_start_screan']:checked").val();
    $("input[name='doors_start_screan']").parent().removeClass('selected');

    $("input[value='" + curent_sreen + "'][name='doors_start_screan']").parent().addClass('selected');
  }


  jQuery("#tabs").tabs({
    active: 0
  });

  // reload the form when the checkbox is changed
  doors_add_ckeckbox_class();
  $('.doors_start_screan').on('click',function (e) {
    if (curent_sreen != $(this).val()) {
      doors_add_ckeckbox_class();
      $(this).closest('form').submit();
    }
  });

  if (typeof wp.media !== 'undefined') {

    var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;

    $('.uploader .button').on('click',function (e) {
      var send_attachment_bkp = wp.media.editor.send.attachment;
      var button = $(this);
      var id = button.attr('id').replace('_button', '');
      _custom_media = true;
      wp.media.editor.send.attachment = function (props, attachment) {
        if (_custom_media) {
          $("#" + id).val(attachment.url);
        } else {
          return _orig_send_attachment.apply(this, [props, attachment]);
        }
        ;
      };

      wp.media.editor.open(button);
      return false;
    });

    $('.add_media').on('click', function () {
      _custom_media = false;
    });

  }


  $('.import-demo-screenshot').on('change', 'input[name=demo_screenshot]:radio', function (e) {
    var input_value = $(this).attr('id');
    $('.import-demo-screenshot label').removeClass("label_selected");
    $("." + input_value).addClass("label_selected");
  });

});

jQuery(window).load(function () {
  jQuery(".wd-cpanel").show();
});

function font_weight_name(weight) {
  switch (weight) {
    case "100":
      return ("Thin 100");
      break;
    case "200":
      return ("Extra-Light 200");
      break;
    case "300":
      return ("Light 300");
      break;
    case "400":
      return ("Regular 400");
      break;
    case "500":
      return ("Medium 500");
      break;
    case "600":
      return ("Semi-Bold 600");
      break;
    case "700":
      return ("Bold 700");
      break;
    case "800":
      return ("Extra-Bold 800");
      break;
    case "900":
      return ("Ultra-bold 900");
      break;
    default:
      return ("");

  }

}