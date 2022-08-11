import React, { FC } from 'react'
import { format_number } from '../utils/utils'

type ClientType = {
  id : string,
  nom : string,
  prenom : string,
  email : string,
  tel : string,
  created_at : string,
  updated_at : string,
}
type TypeLavement = {
  id: number,
  name: string,
  prix_par_kg: number,
  created_at: string,
  updated_at: string,
}

type CommandeModel = {
  client_id: number,
  cout_total: string,
  created_at: string,
  date_livraison: string,
  description: null
  etat: string,
  id: number,
  updated_at: string,
  client : ClientType,
  vetements : any[],
  type_lavage : TypeLavement,
  type_lavage_id : number
}
type DataCommandes = {
  quantite_total_vetement : number,
  commande : CommandeModel,
  date_exp : string
}

type TableType = {
  commandes : DataCommandes[]
}

const Table: FC<TableType> = ({ commandes }) => {

  const gotTo = (url : string):void => {
    window.location.href = url
  }

  return (
    <table className="min-w-full divide-y divide-gray-200">
      <thead className="bg-gray-50">
          <tr>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  prix total
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  livraison
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  état
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Type lavage
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                client
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                vêtements
              </th>
              <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                
              </th>
          </tr>
      </thead>
      <tbody className="bg-white text-gray-600">
        {commandes.map((commande,i) => (
          <tr className={`${i % 2 !== 0 && 'bg-gray-50'}`} key={commande.commande.id}>
            <td className='p-4 whitespace-nowrap text-sm font-normal'>
              <span className="font-extrabold text-gray-500">{format_number(commande.commande.cout_total)}</span>
            </td>
            <td className='p-4 whitespace-nowrap text-sm font-normal text-gray-500'>
              <span className="font-extrabold text-gray-500">{commande.date_exp}</span>
            </td>
            <td className={`p-4 whitespace-nowrap text-sm font-extrabold `}>
              {commande.commande.etat}
            </td>
            <td className={`p-4 whitespace-nowrap text-sm font-extrabold `}>
              {commande.commande.type_lavage.name}
              {!commande.commande.type_lavage.name.toLowerCase().includes('piece') && 
                <>
                  <br />
                  <span>{commande.commande.type_lavage.prix_par_kg} / KG</span>
                </>
              }
            </td>
            <td className="p-4 whitespace-nowrap text-sm">
              <span className='font-semibold'>{commande.commande.client.nom} {commande.commande.client.prenom}</span> <br />
              <span>{commande.commande.client.email}</span>
            </td>
            <td className="p-4 whitespace-nowrap text-sm">
              <span className='font-semibold'>{commande.quantite_total_vetement} Vêtement{commande.quantite_total_vetement > 1 && 's'}</span> <br />
              <span onClick={() => gotTo(`commandes/${commande.commande.id}/vetements`)} className='text-xs cursor-pointer px-2 inline-block py-1 rounded-md text-green-600 bg-green-100 mt-2'>voir l'etat des vêtements</span>
            </td>
            <td className="p-4 whitespace-nowrap text-sm">
              <span onClick={() => gotTo(`commandes/${commande.commande.id}`)} className='px-3 py-1 text-xs cursor-pointer text-white bg-gray-600 rounded-md'>Editer</span>
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  );
}

export default Table;