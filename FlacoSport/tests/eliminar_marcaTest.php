<?php

use PHPUnit\Framework\TestCase;
use tests\FakeDatabase; // Asegúrate de importar la clase desde el namespace correcto
use tests\FakeSession;  // Asegúrate de importar la clase desde el namespace adecuado


class eliminar_marcaTest extends TestCase
{
    protected $db;
    protected $session;

    protected function setUp(): void
    {
        $this->db = new FakeDatabase();
        $this->session = new FakeSession();
    }

    public function testEliminarCategoriaExito()
    {
        // Agregar una categoría de prueba
        $id = $this->db->addCategory("Categoría de prueba");

        // Simular la eliminación de la categoría
        $deleted = $this->db->delete_by_id('categories', $id);

        if ($deleted) {
            $this->session->msg("s", "Categoría eliminada");
        } else {
            $this->session->msg("d", "Eliminación falló");
        }

        $this->assertTrue($deleted);
        $this->assertEquals("s", $this->session->msg());
        $this->assertEquals("Categoría eliminada", $this->session->msg_text());
    }

    public function testEliminarCategoriaFallo()
    {
        // Intentar eliminar una categoría inexistente
        $deleted = $this->db->delete_by_id('categories', 999); // ID inexistente

        if ($deleted) {
            $this->session->msg("s", "Categoría eliminada");
        } else {
            $this->session->msg("d", "Eliminación falló");
        }

        $this->assertFalse($deleted);
        $this->assertEquals("d", $this->session->msg());
        $this->assertEquals("Eliminación falló", $this->session->msg_text());
    }
}
