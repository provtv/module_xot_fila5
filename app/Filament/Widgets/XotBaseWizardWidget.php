<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Modules\Xot\Filament\Traits\HasXotFormAction;

/**
 * Base per widget Filament che espongono un {@see Wizard} nello schema.
 *
 * **Perche esiste (visione / filosofia / religione / zen)**:
 *
 * ## Separazione delle Responsabilita
<<<<<<< HEAD
* - `XotBaseWidget` = contratto generico (senza schema: azioni, viste, traduzioni)
=======
 * - `XotBaseWidget` = contratto generico (senza schema: azioni, viste, traduzioni)
>>>>>>> laraxot/dev
 * - `XotBaseSchemaWidget` = contratto con schema (form lineare, getFormSchema)
 * - `XotBaseWizardWidget` = specializzazione per wizard multi-step
 *   - Gestisce: navigazione step, persistenza `?step=`, submit/render coerenti col vendor
 * - Widget dominio (es. CreateTicketWizardWidget) = campi specifici e business logic
 *
 * ## DRY + KISS
 * - UNA sola implementazione del protocollo wizard:
<<<<<<< HEAD
*   - `?step=` risolto una sola volta al mount, memorizzato in `$wizardStartStep`
=======
 *   - `?step=` risolto una sola volta al mount, memorizzato in `$wizardStartStep`
>>>>>>> laraxot/dev
 *   - Persistenza step in query string (solo se consentito)
 *   - Nessun helper che riscrive l'intero payload dopo `$this->form->getState()` — la forma
 *     è schema/dehydrate + merge espliciti nel widget dominio
 * - Ogni modulo NON reinventa la stessa logica
 *
 * ## Allineamento Filament
 * - Navigazione delegata a `Wizard` / `Step` (documentazione ufficiale v5)
<<<<<<< HEAD
* - Stesso componente `Wizard`, contesto Livewire widget (frontoffice/CMS)
=======
 * - Stesso componente `Wizard`, contesto Livewire widget (frontoffice/CMS)
>>>>>>> laraxot/dev
 * - Questa classe NON sostituisce Filament, incornicia solo gli hook Laraxot comuni
 * - Hook disponibili per override dominio-specifici:
 *   - `configureWizardNextAction()` → label, tooltip, icon del pulsante Avanti
 *   - `configureWizardPreviousAction()` → label, tooltip, icon del pulsante Indietro
 *   - `getWizardSubmitAction()` → rendering pulsante Submit centralizzato in classe base
 *
 * ## Politica Sicurezza
<<<<<<< HEAD
* - Override `?step=` NON è mai implicito in produzione
=======
 * - Override `?step=` NON è mai implicito in produzione
>>>>>>> laraxot/dev
 * - Consentito SOLO se:
 *   - `app()->isLocal()` → true
 *   - `config('app.debug')` → true
 *   - `wizardAllowStepQueryExtra()` → override modulo-specifico (default false)
 *
<<<<<<< HEAD
* @see Wizard
=======
 * @see Wizard
>>>>>>> laraxot/dev
 * @see HasWizard
 * @see \Filament\Resources\Pages\CreateRecord\Concerns\HasWizard
 * @see LangServiceProvider
 * @see AutoLabelAction
 */
abstract class XotBaseWizardWidget extends XotBaseSchemaWidget
{
    use HasWizard {
        getWizardComponent as getParentWizardComponent;
    }
    use HasXotFormAction;

    /** @var ?int Step iniziale (1..N) dopo mount o navigazione; null = ancora da risolvere da ?step=. */
    public ?int $wizardStartStep = null;

    protected int|string|array $columnSpan = 'full';

    /**
<<<<<<< HEAD
    * @return array<int, Wizard>
=======
     * @return array<int, Wizard>
>>>>>>> laraxot/dev
     */
    public function getFormSchema(): array
    {
        return [
            $this->getWizardComponent(),
        ];
    }

    final public function getWizardComponent(): Wizard
    {
        /** @var Wizard $wizard */
        $wizard = $this->getParentWizardComponent();

        $wizard = $wizard->persistStepInQueryString();

        if (! inAdmin()) {
            /** @var view-string $wizardView */
            $wizardView = 'pub_theme::components.wizard';
            if (view()->exists($wizardView)) {
                $wizard = $wizard->view($wizardView);
            }
        }

        return $wizard;
    }

<<<<<<< HEAD
   protected function hasSkippableSteps(): bool
=======
    protected function hasSkippableSteps(): bool
>>>>>>> laraxot/dev
    {
        return true;
    }

    /**
     * Elenco step del wizard. Implementato nel widget concreto.
     *
     * @return array<string, Step>
     */
    abstract public function getSteps(): array;
}
