# Caesar Cipher Decoder

Simple PHP CLI application to apply for the java training 
at [codenation](https://www.codenation.dev/).

## Running

This project uses docker and makefile, to build the image and run all
the tests, execute the following on your terminal:

    make
    
First, let's export the environment variables:

    export CODENATION_BASE_URI=https://api.codenation.dev/v1/
    export CODENATION_TOKEN=<codenation_user_token>
    
Now download the challenge:

    bin/app php bin/console download-challenge answer.json
    
This will save the challenge in the `answer.json` file. To submit
the solution simply run:

    bin/app php bin/console solve-challenge answer.json
    
Or, after exporting the environment variables, just execute:
    make solution
