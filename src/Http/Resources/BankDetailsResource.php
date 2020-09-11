<?php

namespace Codificar\Bank\Http\Resources;

use Codificar\Bank\Models\Bank;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BankDetailsResource
 *
 *
 *
 * @OA\Schema(
 *         schema="BankDetailsResource",
 *         type="object",
 *         description="Retorno Retorno do relatorio de saques do prestador",
 *         title="Bank Details Resource",
 *        allOf={
 *           @OA\Schema(ref="#/components/schemas/BankDetailsResource"),
 *           @OA\Schema(
 *              required={"success", "request"},
 *           )
 *       }
 * )
 */
class BankDetailsResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {

        return [
            'success' => true,
            'generic_report' => $this['generic_report']
        ];
    }

}
