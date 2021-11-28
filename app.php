<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link href="_css/style.css" rel="stylesheet"/>


</head>
<body>

<aside class="publicidade idioma-portugues">
    <h2>Em breve, espaço para publicidade</h2>
</aside>
    
<section class="app idioma-portugues">
    
    <div class="interesses-busca">
        
        <img class="logo" src="_images/logo.png">
    
        <div class="buscador">
        <h2 class="titulo-publico">Público oculto do facebook</h2>
        <form class="form-busca" method="post">

            <input type="text" name="busca" class="busca" required>
            <input type="submit" name="Buscar" value="Buscar" class="buscar" required>

        </form>
        </div>

    </div><!--interesses-busca-->

    <div class="indice">

        <div class="separador_interesse separador_indice">

            <div class="marcador seletor1"></div>
            <div class="ord_interesse seletor1">Ord</div>
            <div class="interesse_individual seletor1">Nome do público</div>
            <div class="tamanho_publico seletor1">Tamanho</div>
            <div class="caminho-vazio seletor1">Caminho de interesse</div>


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
                            throw new Exception("Erro de conexão");
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
                                
                                echo "<div class='interesse_individual'>Nenhum resultado encontrado</div>";
                                
                                echo "<div class='tamanho_publico'>0</div>";

                                echo "<div class='caminho-vazio'>Nenhum resultado encontrado</div>";
                                
                                echo "</div>";
                            
                            }



                        

                    } catch (Exception $e) {
                        echo "<p class='erro'> Ocorreu um erro de conexão com a API do Facebook.</p>";
                    }

                }else{

                    echo "<p class='inicial'>O Facebook Ads te entrega cerca de 30 públicos por interesse, o que provoca uma grande concorrência por esses públicos, mas existem interesses com mais de 300 públicos diferentes, experimente pesquisar por FILMES, por exemplo. Os públicos mostrados aqui no Group Amplifier são os próprios públicos do Facebook, mas aqui mostramos todos eles.</p>";

                }

            ?>

    </div><!--interesses-->


   <div class="total-copiar">

        <div class="total">
            <h3 class="titulo-total">Total: <?php echo $total;?> </h3>
        </div><!--total-->

        <div class="copiar">
            
            <button class="botao-copiar btnMarcar">Marcar todos</button>  
            <button class="botao-copiar btnDesmarcar">desmarcar todos</button>  

            <button id="btnCopiar" class="botao-copiar">Copiar</button>

           
        </div><!--copiar-->
        
    </div><!--total-result-->

    <div class='politica-privacidade'>
        <a class='link-politica-privacidade' href='politica.php' target='_blank'>Política de privacidade</a>
    </div>
    
   		

</section><!--app-->

</body>
</html>