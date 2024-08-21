<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public string $nomeSerie;
    public int $idSerie;
    public int $qtdTemporadas;
    public int $episodiosPorTemporada;

    public function __construct(string $nomeSerie, int $idSerie, int $qtdTemporadas, int $episodiosPorTemporada)
    {
        $this->nomeSerie = $nomeSerie;
        $this->idSerie = $idSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->episodiosPorTemporada = $episodiosPorTemporada;

        $this->subject = "Serie $nomeSerie Criada";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series-created');
    }
}
