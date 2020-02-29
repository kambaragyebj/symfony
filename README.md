Micro- framework . Install the needed packages slowly

1. PHP 7.1 > 

2. Install composer

3. coding standard in symfony

4. Install symfony skeleton

-  composer create-project symfony/website-skeleton my_project_name


#####################RUN ################################################

run:/var/www/symfony4/my_project_name$ php -S 127.0.0.1:8000 -t public 

###########################DIRECTORY #######################################

bin - for unit test

config - configuration files

public -server looks here and reads index.php

src - here a programmer makes all files , e.g controllers, entities etc

var - cache files, sessions etc

vendor - folder for external php libraries

######################REQUIREMENT CHECKER######


- composer require symfony/requirements-checker /check.php in the public/ directory of your project. Open that file with your browser to check the requirements.

-  composer remove symfony/requirements-checker / unintsall once everything is fine

############################### INTALLATION ################################

 Database Configuration 
                        

  * Modify your DATABASE_URL config in .env

  * Configure the driver (mysql) and
    server_version (5.7) in config/packages/doctrine.yaml

              
 How to test? 
              

  * Write test cases in the tests/ folder
  * Run php bin/phpunit


##################### CONFIGURATTION #########################

- most important config file is .env

- most important parameter is environment which our application work. APP_ENV =dev|prod|test

config/packages/dev

- if u want config to be loaded for only dev u can change bundles.php to bundle_dev.php only for specific environment 

- In framework.yaml file u can configure session ###########Main


#################################################FLEX ##################

- https://symfony.sh

search for twig which handles views in symfony application
-symfony/twig-bundle -----click package details

- On the console type : composer require twig-bundle 

###################### LIST ALL COMMAND ###################

- bin/console .....list all available commands in symfony even for installing databases


#####################INSTALL DATABASE PACKAGES #######################

- composer require doctrine

- look at the .env file for modification of database config  name 


####################### HTTP PROCESSING WORKFLOW


1. A user makes an action in a browser (clicks link or send html form)

2. A browser sends a request to symfony on the server 

3. Symfony  creates a REQUEST object that contains data sent by the user ( form data , url parameter)

4. Symfony generates a RESPONSE object using the data of the REQUEST object

5. The browser displays the response to the user ( e.g html page or json string 




################### MVC ################
Routes : Map urls to controller methods , typically exists above a controller method as annotation

Controllers(C): Call entities (if needed ) load views / src/Controller/NameController.php

Entities(M) : Work with database, Src/Entity/EntityName.php

Views(V) : Give html to the user / templates/viewname.html.twig

////////////////ERROR WHILE RUNNING UNIT TEST ????????????????????


If errors appear when running unit tests, add ?ServerVersion=5.7 at the end of the database entry in the .env file:

DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/your_database_name?ServerVersion=5.7 




#####################ERROR ###########################
##################### ERROR ############################

 - symfony/framework-bundle v5.0.4 requires ext-xml

  - solution : sudo apt-get install php7.2-xml
  

Expected to find class "App\Controller\DefaultController" in file "/var/www/html/course2/src/Controller/DefaultController.php" while importing services from resource "../src/*", but it was not found! Check the namespace prefix used with the resource in /var/www/html/course2/config/services.yaml (which is loaded in resource "/var/www/html/course2/config/services.yaml").

$$solution And that's OK, because there's nothing wrong with that. The real problem is that there is a PHP syntax error in your class (e.g. a missing ; at the end of some statement).


##################### MAILER ###############################

 * If you want to send emails asynchronously:

    1. Install the messenger component by running composer require messenger;
    2. Add 'Symfony\Component\Mailer\Messenger\SendEmailMessage': amqp to the
       config/packages/messenger.yaml file under framework.messenger.routing
       and replace amqp with your transport name of choice.

  * Read the documentation at https://symfony.com/doc/master/mailer.html









####################################
#################################### CORE SYMFONY

-------------------- Routes ----------------

Use Annotation |@Route("/default", name="default")

"autoload": {
        "psr-4": {
            "App\\": "src/" its defined in composer.json file
        }

1. Install Maker package inorder not to manually create model and Controller : https://symfony.sh

- /var/www/html/course$ bin/console make:controller DefaultController

---------------------CONTROLLER RETURNS-----------------------------------------------------------------------------------------------------------

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);


        return $this->json(['username'=>'Jackson kambaragye']); for api



        return  new Response('Hello Misaki', $name);

        @Route("/default2/", name="default2")
        return $this->redirectToRoute('default2'); // Redirect to another route
        

[[[[[[[[[[[[[[[[[[[[ Dyamic variable in the url ]]]]]]]]]]]

-http://127.0.0.1:8000/default/jackson

@Route("/default{name}", name="default")

public index($name){

}

----------------------------- VIEW --------------------------------------------------------------------------------------------

overwrite twig
{%block javascripts%}
<script>

 alert(1);

 </script>


{% endblock %}


[[[ for loop ]

 <ul>
     {% for user in users %}
       
        <li>Hello {{ user }}! ✅</li> \\  {{ random_gift[loop.index]}} loop index start from 1 in array values and loop.index0 start from 0

     {%endfor%}

    </ul>


--------------------------- MODEL| ENTITY -------------------------------------------------------------

composer require orm | responsible to handle database operation

- create database : bin/console doctrine:database:create 

DATABASE_URL=mysql://root:aporose@127.0.0.1:3306/symf5db?serverVersion=5.7

- ERROR: https://stackoverflow.com/questions/48135522/symfony-4-doctrine-not-working-from-console-2002-no-such-file-or-directory

- create database : bin/console doctrine:database:create 

- create Entity/Model : bin/console make:entity

  1. Class name of the Entity|Model > User

- Two files created

  * src/Entity/User.php
  * src/Respository/UserRepository.php // Responsible for select queries

  2. New property name \column names in the database

  3. Field type : String .......Type ? to see more option


 $$$$$$$ In controller SAVING TO DATABASE $$$$$$
 
   $entityManager = $this->getDoctrine()->getManager() // Its responsible for saving data to the database | service container object

   $user = new User; Model

   $user->setName('Adam');

   $entityManager->persist($user)

   $entityManager->flush();  // Save in the datbase 

  if error create migration which is resposible for creating sql table

  4. bin/console make:migration
  5. bin/console doctrine:migrations:migrate


 $$$$$$$ In controller GETTING FROM DATABASE USE REPOSITORY $$$$$$$$$$

  $user = $this->getDoctrine()->getRepository(User::class)->findAll();

    return $this->render('default/index.html.twig', [
            'user' => $user,
        ]);


---------------------------------------------------------SERVICES ---------------------------------------------------

- Php classes that do something useful to us
- service container: php class that holds instantions of other php classes 
  e.g Mailer class, Database class or our own class

 - Connect only once no need of instation again

We do n't have to instantiate our service manually smfony will do it for us

- Use dependency injection(autowiring) to get services from service container
  - Put our service in controller as an argument

1. create service folder
    - Services
       - GiftService.php

2. In controller use type int 
     
     public function  index(GiftService $gifts)


3.  bin/console debug:container List all service container


4 my service to use symfony service

 - package for logging
  1 - composer require logger
    
      public function  __construct(LoggerInterface $logger){

          $logger->info('Information regarding the logs");

     }         

            

----------------------------------------------- ADAVANCED ROUTE ---------------------------------------------------


@Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"}) // our page have to be digit --\d+

url = 127.0.0.1:8000/blog/2

@Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"}) // our page is option parameter --- ?

url = 127.0.0.1:8000/blog  or 127.0.0.1:8000/blog/2 but not 127.0.0.1:8000/blog/test not string 




----------------------------------------- Flash Messages----------------------------------

send to the browser for the next request only. Available only once
  


  $user = $this->getDoctrine()->getRepository(User::class)->findAll();

  $this->addFlash() | valid only for the next request takes two element ading messae to the user session

  $this->addFlash(
    'notice_jackson',          | name 

    'Your changes were saved' | value

    )


##################Now in the view  #######################


{% for message in app.flashes('notice_jakckson') %}
    <div class="flash-notice">
        {{ message }}
    </div>
    {% endfor %}

    {% for label, messages in app.flashes %}
        {% for message in messages %}
            <div class="flash-{{ label }}">
                {{ message }}
            </div>
        {% endfor %}
    {% endfor %}
========= Loop many flashes messages . notice_jackson and warning_jackson

 {% for label, messages in app.flashes %}
        {% for message in messages %}
            <div class="flash-{{ label }}">
                {{ message }}
            </div>
        {% endfor %}
    {% endfor %}



-------------------------------------- Cookie --------------------------------------

- How to create Cookie in symfony.

1. import Symfony\Component\HttpFoundation\Cookie

  $cookie = new Cookie(
  'my_cookie, // cookie name
  'cookie_value', //value
  time()+(2*365*24*60*60) // Expires after 2 years

  );

  $res = new Response();

  $res->headers->setCoookie($cookie); Attach cookie to the header

  $res->send(); // SEND COOKIE TO THE BROWSER ////iNSTALL COOKIE INSPECTOR FOR CHROME



 *** CLEAR COOKIE ****

 $res = new  Response();

 $res->headers->clearCookie('my_cookie);

 $res->send();



************** HOW DO WE GET DATA FROM COOKIES && SESSIO ********************



1. import Symfony\Component\HttpFoundation\Request and Symfony\Component\HttpFoundation\Session\SessionInterface;

  public function index(GiftsService $gifts, SessionInterface $session, Request $request){
   
      exit($request->cookies->get('PHPSESSID'));



         
  }

-------------------Creat session--------------------------------------------------------------------------------------


        
        $session->remove('name'); // clear session data with a given name
        $session->clear(); // clear entire session data 





-------------------------------------------POST AND GET 
 import Symfony\Component\HttpFoundation\Request and Symfony\Component\HttpFoundation\Response;


$_GET use=================== $request->query->get('page','default'); // it gets the page or returns to default

$_GET use =================  $request->server->get('HTTP_HOST'); // Display server data

          ================== $request->isXmlHttpRequest(); // is it an Ajax request

       = =================== $request->request->get('page');

         =================== $request->files->get('foo'); get file




---------------------------------- CUSTOM ERROR PAGE 400 , 500 ------------------------
in the .env if you change the environment u wont see error u will 500 or 400 erros
     in templates
             - bundles
                  - TwigBundle
                     - Exception
                         error500.html.twig  / we create this 500 or erro400 can customize by extending base twig


-- bin/console cache:clear



-------------------------------------- HANDLING EXCEPTION -----------------------------------------------------------------
 import Symfony\Component\HttpKernel\Exception\NotFoundHttpException


   if(!user){
   
       throw $this->createNotFoundException('This user does not exist')
         
  }



------------------------------------------- BINDING SERVICES TO CONTROLLER-------------------------------------------

GO TO SERVICE.YAML FILE


- add

    App\Controller\DefaultController:
      bind:
        $logger: '@monolog.logger.doctrine'


Then in Default controller creat the below method


 public function __construct($logger)
    {
        // use $logger service
    }



----------------------------------- GENERATE URL _----------------------------------------------


  /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }


--------------------------------------- DOWNLOAD FILE --------------------------------------


 /**
     * @Route("/download")
     */
    public function download()
    {
        $path =  $this->getParameter('download_directory');
        return $this->file($path.'file.pdf');
    }
}

and in service yml file define the directory 

parameters:
  download_directory: '../public/'




------------------------------------- TWIG INSTALLATION ----------------------------

https://twig.symfony.com/doc/3.x/

/////////sublime format color

To apply syntax highlighting on your Twig HTML files :

    Open a .html.twig file
    Go to View menu → Syntax → Open all with current extension as → HTML (Twig)


\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Check the documentation 


https://twig.symfony.com/doc/3.x/

{% for user in users if user.name =='Susan' %}

  {{user.name}}
{%else%}

   No uses found

 {%enm%}
1. include function used to import another twig view

     {{include('inludes/subview.html.twig', {'users': user})}}


2. to avoid overiding in twig use parent function

{{parent()}}

3. Range for loop //https://twig.symfony.com/doc/3.x/templates.html#other-operators

   {% for i in 1..10 %}

   <div class="{{cycle(['even','odd'],i )}}">

     {{i}}

    </di>


   {% endfor %}


4. Path funtion takes the name of the route 

  {{path('home')}}  /home  not full path.

  {{url('default')} /http://localhost:8000/home full path

  {{asset('images/logo.png')}} links to image or css or js file points to public folder

  {{absolute_url(asset('images/logo.png'))}}

  <img src="{{absolute_url(asset('images/logo.png'))}}" alt="Jackson image">

 

 to use asset function 

  **** composer require symfony/asset *************************

  
---------------------- ESCAPING STRING ---------------------------------------------


{% set string = "some thing \n from \n databses %}


now in javaacript variable 

<script>
var route = "{{ string }}"; this one will have error 

var route = "{{ string|escape('js') }}"; // escape string 

             "{{ string|escape('html') }}"

             "{{ string|escape('css') }}"

alert(route);
</script>



---------------------------------VIEWS GLOBAL VARIABLE ------------------------------------------

-  side bar in every page.

- make a global variables

open twig yaml  file and define global variable 


twig:
    default_path: '%kernel.project_dir%/templates'
    debug: '%kernel.debug%'
    strict_variables: '%kernel.debug%'
    globals:
        ga_code: GAcode-123

and then in index.html.twig

 <p>The google tracking code is: {{ ga_code }}</p>



--------------------------------------------VIEW Webpack Encore Manage Css and Javacript ---------------------------------
https://symfony.com/doc/current/frontend/encore/installation.html
install npm and node js
1. npm init 
2. npm install @symfony/webpack-encore --save-dev
3. npm install --save jquery
4. create webpack.config.js
