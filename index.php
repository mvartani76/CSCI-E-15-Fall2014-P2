<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootswatch: Slate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
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
  $(function() {
    var tooltips = $( "[title]" ).tooltip({
      position: {
        my: "left",
        at: "center center",
        collision: "flipfit"
      }

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
            <p class="lead">Implementation by Mike Vartanian</p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
          </div>
        </div>
      </div>

      <!-- Web App Description Section
      ================================================== -->
      <div class="bs-docs-section">
        <!-- Headings -->

        <div class="row">
            <div class="col-lg-14">
              <div class="well">
                <h2>What is an xkcd Password Generator?</h2>
                  <p class="text-info">   An xkcd Password Generator is a type of password generator that attempts to create memorable passwords for humans that are also difficult for
                                            computers to guess. The basic argument behind the strength of the password is that a longer password will have more entropy than a shorter password
                                            independent of the characters use as a computer does not care if the password contains actual words or not.</p>
              </div>
              <div class="well">              
                <h2>Web App Description</h2>
                  <p class="text-warning">  This web application implements the xkcd password generation function as described by various websites using PHP as the backend language
                                            and HTML/CSS for the front end language for the form input/parameters and display of generated passwords. There is also some javascript and
                                            jQuery added in for some visual effects.</p>
                  <h3>Bootstrap</h3>
                    <p class="text-danger"> A simple, single flat page was employed using the following free bootstrap template called Bootswatch designed by Thomas Park with the source URL located here
                                            <a href="http://bootswatch.com/slate/">Slate Bootswatch Theme</a>. The free theme looked contemporary and the form inputs were very appealing
                                            for this assignment.</p>
                  <h3>Form Inputs</h3>
                    <p class="text-success"> I went back and forth between dropdowns and text boxes in order to make error checking easier. Dropdowns already provide some sort of inherit error
                                            checking as the user can only choose between available options. There are two error checking mechanisms in the code. Both use the POST error checking method.
                                            The first was for the radio button if it is not checked. This only works the first time as values are saved after submitting the form once. The second error
                                            checking was done with the word length. If the Min word length is greater than the Max word length, the code sets the max value to min value + 1. Therefore,
                                            the minimum value options have to be one less than Max.</p>

                  <h3>Wordlist</h3>
                    <p class="text-primary"> Initially I started with a large wordlist with 100k words that had many variants of words such as contractions and possesives.
                                            This took processing time to load and required manual adjustment such as removing the apostrophes to simplify the code and fix errors.
                                            Therefore, I found a Google wordlist with 10k words which was more manageable to work with. The source URL for the Google wordlist is located here
                                            <a href="https://github.com/first20hours/google-10000-english">Google 10k Wordlist</a>.</p>
              </div>
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
      $NumWordsErr = $NumNumsErr = $WordLengthMinErr = $WordLengthMaxErr = $NumCharsErr = $CapWordsErr = $SeparatorErr = "";
      $NumWords = $NumNums = $WordLengthMin = $WordLengthMax = $NumChars = $CapWords = $Separator = "";
  
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
        if (empty($_POST["NumChars"])) {
          $NumCharsErr = "* Must Choose Yes or No";
        } else {
          $NumChars = test_input($_POST["NumChars"]);
        }
        
        if (empty($_POST["Separator"])) {
          $SeparatorErr = "Separator is required";
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

        if (empty($_POST["CapWords"])) {
          $CapWordsErr = "* Must Choose a Value";
        } else {
          $CapWords = test_input($_POST["CapWords"]);
        }
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
                  <div class="form-group">
                    <label for="select1" class="col-lg-4 control-label" title="Number of Words that will be included in the Passphrase">Number of Words</label>
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
                    <label class="col-lg-4 control-label" title="The minimum and maximum of word lengths used in passphrase.
                     Note that there is some simple error checking that will force Max=Min+1 if not set appropriately.">Word Length</label>
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
                    <label for="select3" class="col-lg-4 control-label" title="Number of Numbers to add at the beginning and end of the entire passphrase.">Number of Numbers</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="select3" name="NumNums" value="<?php echo $NumNums;?>">
                        <option <?php if($NumNums==0) echo "selected=\"selected\""; ?>>0</option>
                        <option <?php if($NumNums==1) echo "selected=\"selected\""; ?>>1</option>
                        <option <?php if($NumNums==2) echo "selected=\"selected\""; ?>>2</option>
                        <option <?php if($NumNums==3) echo "selected=\"selected\""; ?>>3</option>
                        <option <?php if($NumNums==4) echo "selected=\"selected\""; ?>>4</option>
                        <option <?php if($NumNums==5) echo "selected=\"selected\""; ?>>5</option>
                        <option <?php if($NumNums==6) echo "selected=\"selected\""; ?>>6</option>
                        <option <?php if($NumNums==7) echo "selected=\"selected\""; ?>>7</option>
                        <option <?php if($NumNums==8) echo "selected=\"selected\""; ?>>8</option>
                        <option <?php if($NumNums==9) echo "selected=\"selected\""; ?>>9</option>
                        <option <?php if($NumNums==10) echo "selected=\"selected\""; ?>>10</option>
                      </select>
                    </div>
                  </div>
                  <p class="text-right my-p">Separator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                  <div class="form-group">
                    <label for="NumChars" class="col-lg-4 control-label" title="The number of special characters to add at the end of each word in passphrase."># of Special Chars</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="NumChars" name="NumChars" value="<?php echo $NumChars;?>">
                        <option <?php if($NumChars==0) echo "selected=\"selected\""; ?>>0</option>
                        <option <?php if($NumChars==1) echo "selected=\"selected\""; ?>>1</option>
                        <option <?php if($NumChars==2) echo "selected=\"selected\""; ?>>2</option>
                        <option <?php if($NumChars==3) echo "selected=\"selected\""; ?>>3</option>
                        <option <?php if($NumChars==4) echo "selected=\"selected\""; ?>>4</option>
                        <option <?php if($NumChars==5) echo "selected=\"selected\""; ?>>5</option>
                        <option <?php if($NumChars==6) echo "selected=\"selected\""; ?>>6</option>
                        <option <?php if($NumChars==7) echo "selected=\"selected\""; ?>>7</option>
                        <option <?php if($NumChars==8) echo "selected=\"selected\""; ?>>8</option>
                        <option <?php if($NumChars==9) echo "selected=\"selected\""; ?>>9</option>
                        <option <?php if($NumChars==10) echo "selected=\"selected\""; ?>>10</option>
                      </select>
                    </div>
                      <div class="col-lg-3 col-lg-offset-2">
                        <select class="my-form-control" id="Separator" name="Separator" title="Type of separator to use between words in passphrase." value="<?php echo $Separator;?>">
                          <option <?php if($Separator== "-") echo "selected=\"selected\""; ?>>-</option>
                          <option <?php if($Separator== "&nbsp;") echo "selected=\"selected\""; ?>>&nbsp;</option>
                          <option <?php if($Separator== "_") echo "selected=\"selected\""; ?>>_</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-10 control-label" title="Choose between all uppercase, all lowercase, or just capitalizing the first letter of each word">
                          Capitalization Options<span class="error"> <?php echo "&nbsp;$CapWordsErr";?></span></label>
                    
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" id="CapWords" name="CapWords" <?php if (isset($CapWords) && $CapWords=="UpperCase")
                                                                                        echo "checked";?> value="UpperCase">All Uppercase</label>

                        <label>
                          <input type="radio" id="CapWords" name="CapWords" <?php if (isset($CapWords) && $CapWords=="FirstLetterCap")
                                                                                        echo "checked";?> value="FirstLetterCap">Only First Letter Uppercase</label>
                        <label>
                          <input type="radio" id="CapWords" name="CapWords" <?php if (isset($CapWords) && $CapWords=="LowerCase")
                                                                                        echo "checked";?> value="LowerCase">All Lowercase</label>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <fieldset id="submit-field">
                  <div class="form-group">
                    <div class="col-lg-12">
                      <button type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">Submit</button>
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
                  <label class="control-label text-warning">Password 1</label>
                  <input type="text"  class="form-control" id="inputDefault" value ="<?php if ( isset( $_POST['submit'] ) ) {
                                                    print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapWords,$NumChars));} ?>">
                </div>

                <div class="form-group">
                  <label class="control-label text-info">Password 2</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php if ( isset( $_POST['submit'] ) ) {
                                                    print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapWords,$NumChars));} ?>">
                </div>

                <div class="form-group">
                  <label class="control-label text-danger">Password 3</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php if ( isset( $_POST['submit'] ) ) {
                                                    print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapWords,$NumChars));} ?>">
                </div>

                <div class="form-group">
                  <label class="control-label text-success">Password 4</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php if ( isset( $_POST['submit'] ) ) {
                                                    print_r(generate_password($NumWords,$Separator,$NumNums,$WordLengthMin,$WordLengthMax,$CapWords,$NumChars));} ?>">
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <div class="row">
          <div class="col-lg-16">
            <ul class="list-inline center-block">
              <li><a href="https://www.facebook.com/mike.vartanian"><img src="http://mikevartanian.me/CSCI-E-15-Assets/images/facebook.png" height="50" width="50" alt="facebook"></a></li>
              <li><a href="https://twitter.com/mvartani76"><img src="http://mikevartanian.me/CSCI-E-15-Assets/images/twitter.png" height="50" width="50" alt="twitter"></a></li>
              <li><a href="https://plus.google.com/+MikeVartanian/posts"><img src="http://mikevartanian.me/CSCI-E-15-Assets/images/google-plus.png" height="50" width="50" alt="google+"></a></li>
              <li><a href="http://www.pinterest.com/mikevartanian/"><img src="http://mikevartanian.me/CSCI-E-15-Assets/images/pinterest.png" height="50" width="50" alt="pinterest"></a></li>
              <li><a href="https://www.linkedin.com/pub/michael-vartanian/3/906/549/"><img src="http://mikevartanian.me/CSCI-E-15-Assets/images/linkedin.png" height="50" width="50" alt="linkedin"></a></li>
            </ul>
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
