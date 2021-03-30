<?php

use PHPUnit\Framework\TestCase;

use App\Peleador;

class PeleadorTest extends TestCase
{
    public function test_puedo_crear_un_peleador_con_un_nombre()
    {
        $goku = new Peleador("Goku");

        $this->assertEquals("Goku", $goku->getNombre());
    }

    public function test_pudo_definir_su_total_de_vida()
    {
        $goku = new Peleador("Goku");

        $goku->setVidaTotal(1000);

        $this->assertEquals(1000, $goku->getVidaTotal());
    }

    public function test_pudo_definir_su_velocidad()
    {
        $goku = new Peleador("Goku");

        $goku->setVelocidad(20);

        $this->assertEquals(20, $goku->getVelocidad());
    }

    public function test_pudo_definir_su_poder_de_pelea()
    {
        $goku = new Peleador("Goku");

        $goku->setPoderDePelea(500);

        $this->assertEquals(500, $goku->getPoderDePelea());
    }

    public function test_puedo_decir_si_tiene_toda_la_informacion()
    {
        $goku = new Peleador("Goku");
        $this->assertFalse($goku->estaListoParaPelear());

        $goku->setVidaTotal(1000);
        $goku->setVelocidad(20);
        $goku->setPoderDePelea(500);
        $this->assertTrue($goku->estaListoParaPelear());
    }
}
