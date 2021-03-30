<?php

use PHPUnit\Framework\TestCase;

use App\Peleador;
use App\Pelea;
use App\Resultado;

class PeleaTest extends TestCase
{
    public function test_puede_asignar_peleadores()
    {
        $goku = new Peleador("Goku");
        $vegeta = new Peleador("Vegeta");

        $pelea = new Pelea($goku, $vegeta);

        $this->assertEquals("Goku", $pelea->getPeleador1()->getNombre());
        $this->assertEquals("Vegeta", $pelea->getPeleador2()->getNombre());
    }

    public function test_devuelve_false_si_la_pelea_no_esta_lista()
    {
        $goku = new Peleador("Goku");
        $vegeta = new Peleador("Vegeta");

        $pelea = new Pelea($goku, $vegeta);

        $this->assertFalse($pelea->estaListaParaEmpezar());
    }

    public function test_devuelve_true_si_la_pelea_esta_lista()
    {
        $goku = new Peleador("Goku");
        $goku->setVidaTotal(1000);
        $goku->setVelocidad(20);
        $goku->setPoderDePelea(500);

        $vegeta = new Peleador("Vegeta");
        $vegeta->setVidaTotal(900);
        $vegeta->setVelocidad(25);
        $vegeta->setPoderDePelea(300);

        $pelea = new Pelea($goku, $vegeta);

        $this->assertTrue($pelea->estaListaParaEmpezar());
    }

    public function test_tira_error_si_queremos_comenzar_y_no_estan_listos()
    {
        $this->expectException("Peleadores no listos");

        $goku = new Peleador("Goku");
        $vegeta = new Peleador("Vegeta");

        $pelea = new Pelea($goku, $vegeta);

        $pelea->combate();
    }

    public function test_el_peleador_mas_rapido_comienza_el_combate()
    {
        $goku = new Peleador("Goku");
        $goku->setVidaTotal(1000);
        $goku->setVelocidad(20);
        $goku->setPoderDePelea(500);

        $vegeta = new Peleador("Vegeta");
        $vegeta->setVidaTotal(900);
        $vegeta->setVelocidad(25);
        $vegeta->setPoderDePelea(300);

        $pelea = new Pelea($goku, $vegeta);

        $masRapido = $pelea->quienPegaPrimero();

        $this->assertEquals("Vegeta", $masRapido->getNombre());
    }

    public function test_la_pelea_tiene_un_ganador()
    {
        $goku = new Peleador("Goku");
        $goku->setVidaTotal(1000);
        $goku->setVelocidad(20);
        $goku->setPoderDePelea(500);

        $vegeta = new Peleador("Vegeta");
        $vegeta->setVidaTotal(900);
        $vegeta->setVelocidad(25);
        $vegeta->setPoderDePelea(300);

        $pelea = new Pelea($goku, $vegeta);

        // Aca la idea es que dara la velocidad es el que pega primero
        // y desde ahi un golpe cada uno
        // el primero que se quede sin vida pierde

        // en este caso vegeta pega primero sacando 300 goku queda con 700
        // goku pega sacando 500 dejando a vegeta en 400
        // pega vegeta dejando a goku en 400
        // y goku termina sacando otro 500 dejando a vegeta en -100

        $resultado = $pelea->combate();

        $this->assertInstanceOf(Resultado::class, $resultado);

        $this->assertEquals("Goku", $resultado->vencedor()->getNombre());
    }
}
