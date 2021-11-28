<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="_css/style.css" rel="stylesheet"/>


</head>
<body>

<aside class="publicidade idioma-ingles">
    <h2>Soon, space for advertising</h2>
</aside>
    
<section class="app idioma-ingles">
    
    <div class="interesses-busca">

        <img class="logo" src="_images/logo.png">
    
        <div class="buscador">
        <h2 class="titulo-publico">Facebook hidden audience</h2>
        <form class="form-busca" method="post">

            <input type="text" name="busca" class="busca" required>
            <input type="submit" name="Buscar" value="Search" class="buscar" required>

        </form>
        </div>

    </div><!--interesses-busca-->

    <div class="indice">

        <div class="separador_interesse separador_indice">

            <div class="marcador seletor1"></div>
            <div class="ord_interesse seletor1">Ord</div>
            <div class="interesse_individual seletor1">Audience name</div>
            <div class="tamanho_publico seletor1">Size</div>
            <div class="caminho-vazio seletor1">Path</div>


        </div>

    </div>
    
    
    <div class="interesses">

        


            <?php

                $total = 0;

                if(isset($_POST['busca'])){

                        $interesse = urlencode($_POST['busca']);

                        $url = 'https://graph.facebook.com/search?type=adinterest&q=['.$interesse.']&limit=10000&locale=pt_BR&access_token='.TOKEN;

                    try {

                        if(@file_get_contents($url) === false){
                            throw new Exception("Connection error");
                        }
                        
                        $result = @file_get_contents($url);

                
                    
                    

                        $result_decode = json_decode($result);

                        $ord = 1;

                    

                        foreach($result_decode -> data as $interesse_relacionado){

                                echo "<div class='separador_interesse'>";

                                echo "<div class='marcador'><input class='check' type='checkbox' name='interesse[]' value='".$interesse_relacionado->name."'></div>";

                                echo "<div class='ord_interesse'>".$ord."</div>";
                                
                                echo "<div class='interesse_individual'>".$interesse_relacionado->name."</div>";
                                
                                echo "<div class='tamanho_publico'>".number_format($interesse_relacionado->audience_size)."</div>";

                                echo "<div class='caminho'>";

                                $quant = count($interesse_relacionado->path);
                                $contatador = 0;
                                foreach($interesse_relacionado -> path as $path){
                                    $contatador++;
                                    
                                    if($contatador == $quant){

                                        echo "<div class='path'>".$path."</div>";

                                    }else{
                                    echo "<div class='path'>".$path."<span class='seta'> > <span></div>";
                                    }

                            
                                }
                                
                                echo "</div>";

                                echo "</div>";
            
                                $ord = $ord + 1;

                                }

                                $total = count($result_decode->data);
                                
                        if($ord == 1){

                                echo "<div class='separador_interesse'>";

                                echo "<div class='ord_interesse'>0</div>";
                                
                                echo "<div class='interesse_individual'>no results found</div>";
                                
                                echo "<div class='tamanho_publico'>0</div>";

                                echo "<div class='caminho-vazio'>no results found</div>";
                                
                                echo "</div>";
                            
                            }



                        

                    } catch (Exception $e) {
                        echo "<p class='erro'>There was an error connecting to the Facebook API.</p>";
                    }

                }else{

                    echo "<p class='inicial'>The Facebook Ads gives you about 30 audiences per interest, which causes great competition for these audiences, but there are interests with more than 300 different audiences, try searching for FILMS, for example. The audiences shown here at Group Amplifier are Facebook's own audiences, but here we show them all.</p>";

                }

            ?>

    </div><!--interesses-->


   <div class="total-copiar">

        <div class="total">
            <h3 class="titulo-total">Total: <?php echo $total;?> </h3>
        </div><!--total-->

        <div class="copiar">
            
            <button class="botao-copiar btnMarcar">Check all</button>  
            <button class="botao-copiar btnDesmarcar">deselect all</button>  

            <button id="btnCopiar" class="botao-copiar">Copy</button>

           
        </div><!--copiar-->
        

   </div><!--total-result-->
</section><!--app-->

</body>
</html>