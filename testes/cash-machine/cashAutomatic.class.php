<?php
    
    class cashAutomatic
    {
        public function procesa($entregaInicial)
        {
            $billetes = array();
            $entrega = $entregaInicial;
            $acumula = 0;
            $go = false;
            $notasDisponivles =  array('100,00', '50,00', '20,00', '10,00');
            if(!$entregaInicial)
            {
                return array('Error' => "Deve digitar um valor maior que 0") ;
            }
            if(is_numeric($entregaInicial) && $entregaInicial < 0)
            {
                return array('Error' => utf8_encode("Não há números negativos permitidos")) ;
            }
            if( substr($entregaInicial, -1) == 5)
            {
                return array('Error' => utf8_encode("A quantidade solicitada não pode ser processado")) ;
            }
            
            
            
            // recorre los montos disponibles
            for($i = 0; $i < 4; $i++)
            {
                // Procesa los billetes a dispensar
                $r = $this->obtieneEntero($entrega,$notasDisponivles[$i]);
                if(is_array($r))
                {
                    // Acumulado 
                    $acumula = $acumula + $r[1];
                    $salida = array($r[0] => $notasDisponivles[$i]) ;
                    $billetes[] = $salida;
                    // Si son iguales, se completo el total del monto solicitado
                    if($acumula == $entregaInicial)
                    {
                        $go = true;
                        break;
                    }
                    $entrega = $r[2];
                }
            }
            if(!$go)
            {
                return array('Error' => "A quantidade solicitada não pode ser processado") ;                
            }
            return $billetes;
            
        }
        
        protected function obtieneEntero($valor, $numero)
        {
            $arr = null ;
            $operacion = $valor / floor($numero);
            // Parte entera de la operacion
            $valInt = floor($operacion);
            if($valInt > 0)
            {
                // Obtiene el resto de la operacion para obtener el monto restante
                $res = $valInt * (round($numero)) ;
                $valor = $valor % floor($numero);
                $arr = array($valInt, $res, $valor);
            }
            return $arr;
        }
                
    }
    

?>