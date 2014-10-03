<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootswatch: Slate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" type="text/css" href="mbTooltip.css" title="style1"  media="screen">    
    <script type="text/javascript" src="jquery.timers.js"></script>
    <script type="text/javascript" src="mbTooltip.js"></script>

<script type="text/javascript">

function saveScrollPositions(theForm) {

if(theForm) {

var scrolly = typeof window.pageYOffset != 'undefined' ? window.pageYOffset : document.documentElement.scrollTop;

var scrollx = typeof window.pageXOffset != 'undefined' ? window.pageXOffset : document.documentElement.scrollLeft;

theForm.scrollx.value = scrollx;

theForm.scrolly.value = scrolly;

}

}

</script>


    <script>
      $(function(){
        $("body").mbTooltip({ // also $([domElement]).mbTooltip  >>  in this case only children element are involved
          opacity : .97,       //opacity
          wait:1200,           //before show
          cssClass:"default",  // default = default
          timePerWord:70,      //time to show in milliseconds per word
          hasArrow:false,     // if you whant a little arrow on the corner
          hasShadow:true,
          imgPath:"images/",
          anchor:"mouse", //"parent"  you can anchor the tooltip to the mouse position or at the bottom of the element
          shadowColor:"black", //the color of the shadow
          mb_fade:200 //the time to fade-in
        });
      });
    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>

    <?php
      require 'xkcdpasswd.php';
      ?>

  </head>

  <body>
    
    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>xkcd Password Generator</h1>
            <p class="lead">Shades of gunmetal gray</p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
          </div>
        </div>
      </div>

      <!-- Typography
      ================================================== -->
      <div class="bs-docs-section">
        <!-- Headings -->

        <div class="row">
          <div class="col-lg-14">
              <h2>Web App Description</h2>
                <p class="text-warning">  This web application implements the xkcd password generation function as described by various websites using PHP as the backend language
                                          and HTML/CSS for the front end language for the form input/parameters and display of generated passwords.</p>
                <h3>Bootstrap</h3>
                  <p class="text-info">   A simple, single flat page was employed using the following free bootstrap template designed by Thomas Park with the source URL located here
                                          <a href="http://bootswatch.com/slate/">Slate Bootswatch Theme</a>. The free theme looked contemporary and the form inputs were very appealing
                                          for this assignment.</p>
                <h3>Form Inputs</h3>
                  <p class="text-danger"> Initially, I used &lt;select&gt; dropdown input methods to select the number of words and number but as it forced them inputs as integer, I changed
                                          to text input to implement some error checking functionality. I also removed default checked values for the radio buttons again to implement the error
                                          checking functionality.</p>

                <h3>Wordlist</h3>
                  <p class="text-danger"> To simplify the code, I removed apostrophes from words in wordlist as it was causing errors. Removed 20 words.
https://github.com/first20hours/google-10000-english
          </div>
        </div>
      </div>

      <!-- Forms
      ================================================== -->
      <div class="bs-docs-section">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms" title="what the hell is this?">Let's Generate Some Passwords!!</h1>
            </div>
          </div>
        </div>


    <?php
      $NumWordsErr = $NumNumsErr = $WordLengthMinErr = $WordLengthMaxErr = $SpecialCharsErr = $CapFirstLetterErr = $SeparatorErr = "";
      $NumWords = $NumNums = $WordLengthMin = $WordLengthMax = $SpecialChars = $CapFirstLetter = $Separator = "";
  
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["NumWords"])) {
          $NumWordsErr = "NumWords is required";
        } else {
          $NumWords = test_input($_POST["NumWords"]);
          
          if (!preg_match('/^[0-9]{0,1}$/',$NumWords)) {
            $NumWordsErr = "Only digits 0-9 allowed";
          } else {
            $NumWordsErr = "";
          }
        }

        if (empty($_POST["NumNums"])) {
          $NumNumsErr = "Email is required";
        } else {
          $NumNums = test_input($_POST["NumNums"]);
        }
        if (empty($_POST["SpecialChars"])) {
          $SpecialCharsErr = "* Must Choose Yes or No";
        } else {
          $SpecialChars = test_input($_POST["SpecialChars"]);
        }
        
        if (empty($_POST["Separator"])) {
          $SeparatorErr = "Email is required";
        } else {
          $Separator = test_input($_POST["Separator"]);
        }

        if (empty($_POST["WordLengthMin"])) {
          $WordLengthMinErr = "Email is required";
        } else {
          $WordLengthMin = test_input($_POST["WordLengthMin"]);
        }

        if (empty($_POST["WordLengthMax"])) {
          $WordLengthMaxErr = "Email is required";
        } else {
          $WordLengthMax = test_input($_POST["WordLengthMax"]);
          if ($WordLengthMax <= $WordLengthMin)
            $WordLengthMax = $WordLengthMin+1;
        }

        if (empty($_POST["CapFirstLetter"])) {
          $CapFirstLetterErr = "* Must Choose Yes or No";
        } else {
          $CapFirstLetter = test_input($_POST["CapFirstLetter"]);
        }
            echo $SpecialChars;
            echo $CapFirstLetter;
      }

        function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data; }

    ?>

    
        <div class="row">
          <div class="col-lg-6">
            <div class="well-password">
              <form name="myform" method="post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return saveScrollPositions(this);">
                <input type="hidden" name="scrollx" id="scrollx" value="0" />

                <input type="hidden" name="scrolly" id="scrolly" value="0" />

                <fieldset>
                  <legend>Password Parameters</legend>
                  <?php echo $NumWords;?>
                  <div class="form-group">
                    <label for="select1" class="col-lg-4 control-label">Number of Words</label>
                    <div class="col-lg-3">
                      <select required class="form-control" id="select1" name="NumWords" value="<?php echo $NumWords;?>">
          
                        <option <?php if($NumWords==2) echo "selected=\"selected\""; ?>>2</option>
                        <option <?php if($NumWords==3) echo "selected=\"selected\""; ?>>3</option>
                        <option <?php if($NumWords==4) echo "selected=\"selected\""; ?>>4</option>
                        <option <?php if($NumWords==5) echo "selected=\"selected\""; ?>>5</option>
                        <option <?php if($NumWords==6) echo "selected=\"selected\""; ?>>6</option>
                        <option <?php if($NumWords==7) echo "selected=\"selected\""; ?>>7</option>
                        <option <?php if($NumWords==8) echo "selected=\"selected\""; ?>>8</option>
                        <option <?php if($NumWords==9) echo "selected=\"selected\""; ?>>9</option>
                        <option <?php if($NumWords==10) echo "selected=\"selected\""; ?>>10</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label">Word Length</label>
                    <div class="col-lg-3">
                      <select class="my-form-control" id="WordMin" name="WordLengthMin" value="<?php echo $WordLengthMin;?>">
                        <option <?php if($WordLengthMin==1) echo "selected=\"selected\""; ?>>1</option>
                        <option <?php if($WordLengthMin==2) echo "selected=\"selected\""; ?>>2</option>
                        <option <?php if($WordLengthMin==3) echo "selected=\"selected\""; ?>>3</option>
                        <option <?php if($WordLengthMin==4) echo "selected=\"selected\""; ?>>4</option>
                        <option <?php if($WordLengthMin==5) echo "selected=\"selected\""; ?>>5</option>
                        <option <?php if($WordLengthMin==6) echo "selected=\"selected\""; ?>>6</option>
                        <option <?php if($WordLengthMin==7) echo "selected=\"selected\""; ?>>7</option>
                        <option <?php if($WordLengthMin==8) echo "selected=\"selected\""; ?>>8</option>
                        <option <?php if($WordLengthMin==9) echo "selected=\"selected\""; ?>>9</option>
                        <option <?php if($WordLengthMin==10) echo "selected=\"selected\""; ?>>10</option>
                      </select>
                      <label for="WordMin" class="col-lg-offset-4">Min</label>
                    </div>
                    <div class="col-lg-3 col-lg-offset-2">
                      <select class="my-form-control" id="WordMax" name="WordLengthMax" value="<?php echo $WordLengthMax;?>">
                        <option <?php if($WordLengthMax==1) echo "selected=\"selected\""; ?>>1</option>
                        <option <?php if($WordLengthMax==2) echo "selected=\"selected\""; ?>>2</option>
                        <option <?php if($WordLengthMax==3) echo "selected=\"selected\""; ?>>3</option>
                        <option <?php if($WordLengthMax==4) echo "selected=\"selected\""; ?>>4</option>
                        <option <?php if($WordLengthMax==5) echo "selected=\"selected\""; ?>>5</option>
                        <option <?php if($WordLengthMax==6) echo "selected=\"selected\""; ?>>6</option>
                        <option <?php if($WordLengthMax==7) echo "selected=\"selected\""; ?>>7</option>
                        <option <?php if($WordLengthMax==8) echo "selected=\"selected\""; ?>>8</option>
                        <option <?php if($WordLengthMax==9) echo "selected=\"selected\""; ?>>9</option>
                        <option <?php if($WordLengthMax==10) echo "selected=\"selected\""; ?>>10</option>
                      </select>
                      <label for="WordMax" class="col-lg-offset-4">Max</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="select3" class="col-lg-4 control-label">Number of Numbers</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="select3" name="NumNums" value="<?php echo $NumNums;?>">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="SpecialChars" class="col-lg-4 control-label">Special Characters?</label>
                    <label for="Separator" class="col-lg-3 col-lg-offset-5 control-label">Separator?</label>
                    <div class="col-lg-6">
                      <div class="radio">
                        <label>
                          <input type="radio" id="SpecialChars" name="SpecialChars" <?php echo $SpecialChars; if (isset($SpecialChars) && $SpecialChars=="Yes") echo "checked";?> value="Yes">
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="SpecialChars" name="SpecialChars" <?php echo $SpecialChars; if (isset($SpecialChars) && $SpecialChars=="No") echo "checked";?>value="No">
                          No
                        </label>
                        <span class="error"> <?php echo  $SpecialCharsErr;?></span>
                      </div>
                    </div>
                      <div class="col-lg-3 col-lg-offset-3">
                        <select class="my-form-control" id="Separator" name="Separator" value="<?php echo $Separator;?>">
                          <option>-</option>
                          <option></option>
                          <option>_</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-4 control-label">Capitalize First Letter?</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" id="CapFirstLetter" name="CapFirstLetter" <?php echo $CapFirstLetter; if (isset($CapFirstLetter) && $CapFirstLetter=="Yes") echo "checked";?> value="Yes">
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="CapFirstLetter" name="CapFirstLetter" <?php echo $CapFirstLetter; if (isset($CapFirstLetter) && $CapFirstLetter=="No") echo "checked";?> value="No">
                          No
                        </label>
                        <span class="error"> <?php echo $CapFirstLetterErr;?></span>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <fieldset id="submit-field">
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="well-password">
              <fieldset id="outputs">
                <legend>Password Outputs<legend>
                <br>
                <div class="form-group">
                  <label class="control-label">Password 1</label>
                  <input type="text"  class="form-control" id="inputDefault" value ="<?php if ( isset( $_POST['submit'] ) ) {print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapFirstLetter));} ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Password 2</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapFirstLetter)); ?>">
                </div>

                <div class="form-group">
                  <label>Password 3</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapFirstLetter)); ?>">
                </div>

                <div class="form-group">
                  <label>Password 4</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapFirstLetter)); ?>">
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
      <pre>
      <?php

      //$passout=generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax);
      $passout=generate_password($NumWords,$Separator,$NumNums,3,6);
      echo "NumWords = $NumWords";
      echo "NumNums = $NumNums";
      //print_r($passout);
      ?>
    </pre>


      <footer>
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
              <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
              <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
              <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
              <li><a href="../help/#api">API</a></li>
              <li><a href="../help/#support">Support</a></li>
            </ul>
            <p>Made by <a href="http://thomaspark.me" rel="nofollow">Thomas Park</a>. Contact him at <a href="mailto:thomas@bootswatch.com">thomas@bootswatch.com</a>.</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

          </div>
        </div>

      </footer>


    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="bootswatch.js"></script>


<?php

$scrollx = 0;
$scrolly = 0;

if(!empty($_REQUEST['scrollx'])) {

$scrollx = $_REQUEST['scrollx'];

}

if(!empty($_REQUEST['scrolly'])) {

$scrolly = $_REQUEST['scrolly'];

}

?>

<script type="text/javascript">

window.scrollTo(<?php echo "$scrollx" ?>, <?php echo "$scrolly" ?>);

</script>

  </body>
</html>
