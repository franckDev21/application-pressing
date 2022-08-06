import React, { ChangeEvent, FC, useEffect, useState } from 'react'
import './index.scss';
import axios from 'axios';
import FormClient from '../FormClient/FormClient';
import { format_number } from '../utils/utils';

type CommandeType = {
  id ?: string
}

type ClientType = {
  id : string,
  nom : string,
  prenom : string,
  email : string,
  tel : string,
  created_at : string,
  updated_at : string,
}

type VetementModel = {
  id: number,
  qte : number,
  prix_unitaire : number,
  type_vetement_id : number | null,
  action ?: string
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
}

const Commande : FC<CommandeType> = ({id}) => {

  const [clientId,setClientId] = useState('');
  const [clients,setClients] = useState([]);
  const [vetementTypes,setVetementTypes] = useState([]);
  const [vetements,setVetements] = useState<VetementModel[]>([]);
  const [dateLivraison,setdateLivraison] = useState('');
  const [commandeState,setCommandeState] = useState<any>(null);
  const [description,setDescription] = useState<string|null>(null);

  const [addNewClientState,setAddNewClientState] = useState(false);


  const [showAddClient,setShowAddClient] = useState(false);
  const [load,setLoad] = useState(false);

  const addVetement = () => {
    const vetement: VetementModel = {
      id : Date.now(),
      qte : 0,
      prix_unitaire : 0,
      type_vetement_id : (vetementTypes[0] as any).id,
      action : 'add'
    }

    setVetements([...vetements,vetement]);
  }

  const updateVetement = (e : ChangeEvent<HTMLInputElement|HTMLSelectElement>,field: string,id :number) => {
    
    let copiVetements = vetements.filter(el => el.id !== id);

    let copiVetementFind : any = vetements.find(el => el.id === id);

    switch (field) {
      case 'QTE':
        copiVetementFind = {...copiVetementFind,qte: e.target.value}
        break;
      case 'PRIX':
        copiVetementFind = {...copiVetementFind,prix_unitaire: e.target.value}
        break;
      default:
        copiVetementFind = {...copiVetementFind,type_vetement_id: e.target.value}
        break;
    }

    copiVetements = [...copiVetements,copiVetementFind];
    
    setVetements(copiVetements);

  }

  const deleteVetement = (id: number) => {
    let vetement = vetements.find(el => el.id === id);
    (vetement as VetementModel).action = 'delete';
    
    let copiVetements = vetements.filter(el => el.id !== id);
    setVetements([...copiVetements,(vetement as VetementModel)]);
  }

  const calculTotal = ():number => {
    let somme:number = 0;
    vetements.forEach(vetement => {
      if((vetement.action || '') !== 'delete'){
        somme += multiplication(vetement.qte,vetement.prix_unitaire);
      }
    });
    return somme;
  }

  const calculTotalVetement = ():number => {
    let somme:number = 0;
    vetements.forEach(vetement => {
      if((vetement.action || '') !== 'delete'){
        somme += (parseInt(vetement.qte.toString(),10) || 0);
      }
    });
    return somme;
  }

  const multiplication = (qte: number,pu: number): number => {
    return qte * pu;
  }

  const handleSubmitForm = () => {
    
    // store
    if(!id){
      const data = {
        commande : {
          client_id : clientId,
          cout_total : calculTotal(),
          date_livraison: dateLivraison,
          description
        },
        vetements
      }
      
      setLoad(true);
  
      axios.post('https://clear-pressing.herokuapp.com/commandes',data).then(res => {
        setLoad(false);
        if(res.data.success){
          let id = +res.data.commande_id;
          (window.location as any) = `/commandes/${id}`;
        }
      }).catch(err => {
        console.log(err); 
        setLoad(false);
      });
    }else{ // update
      setLoad(true);

      delete commandeState?.vetements

      const data_commande = {
        commande : {
          ...commandeState,
          description : description,
          client_id : parseInt(clientId,10),
          date_livraison : dateLivraison,
          cout_total : calculTotal(),
        },
        vetements
      }
      
      axios.patch(`https://clear-pressing.herokuapp.com/commandes/${id}`,data_commande).then(res => {
        setLoad(false);
        if(res.data.message === 'success'){
          (window.location as any) = '/commandes';
        }
      }).catch(err => {
        console.log(err); 
        setLoad(false);
      });

    }

  }

  const initCommande = (commande : CommandeModel,vetements: any[],date : string) => {
    setdateLivraison(date);
    setClientId(commande.client_id.toString());
    setDescription(commande.description);

    let tabVetements :any = [];

    vetements.forEach(vetement => {
      tabVetements.push({
        id: vetement.id,
        qte : vetement.quantite,
        prix_unitaire : vetement.prix_unitaire,
        type_vetement_id : vetement.type_vetement_id
      });
    });

    setVetements([...tabVetements]);
  }

  useEffect(() => {
    axios.get('https://clear-pressing.herokuapp.com/clients/api').then(res => {
      setClients(res.data);
    }).catch(err => console.log(err));

    axios.get('https://clear-pressing.herokuapp.com/commandes/vetements/api').then(res => {
      setVetementTypes(res.data);
    }).catch(err => console.log(err));

    if(id){
      axios.get(`https://clear-pressing.herokuapp.com/commandes/${id}/api`).then(res => {
        setCommandeState(res.data.commande);
        initCommande(res.data.commande,res.data.vetements,res.data.date_format);
      }).catch(err => console.log(err));
    }

  },[]);

  useEffect(() => {
    axios.get('https://clear-pressing.herokuapp.com/clients/api').then(res => {
      setClients(res.data);
    }).catch(err => console.log(err));
  },[addNewClientState]);
  
  useEffect(() => {
    calculTotal();
    calculTotalVetement();
  },[vetements]);


  return (
    <div className='p-4 bg-white rounded-md mt-3 shadow'>
      {!showAddClient ? (
        <>
          <h1 className='text-xl font-bold text-gray-400 mb-3'>Client</h1>
          <div className="flex items-center mb-5">
            <select onChange={(e) => setClientId(e.target.value)} value={clientId} className='px-14 w-2/3 py-1 border-none outline-none ring-0  focus:outline-none focus:ring-0 rounded-md bg-gray-100'>
              <option value=''>selectionnez un client</option>
              {clients.map((client : ClientType) => (
                <option value={client.id} key={client.id}>{client.prenom} {client.nom}</option>
              ))}
            </select>
           <div className='flex items-center justify-between w-1/3'>
            <input onChange={(e) => setdateLivraison(e.target.value)} value={dateLivraison} type="date" placeholder='date' className='ml-2 w-1/2 px-4 py-1 border-none outline-none ring-0  focus:outline-none focus:ring-0 rounded-md bg-gray-100' />
            {!id && <button onClick={() => setShowAddClient(true)} className='px-3 w-1/2 py-1 rounded-md bg-cyan-600 text-white ml-2'>Nouveau client</button>}
           </div>
          </div>

          <textarea value={description || ''} onChange={(e) => setDescription(e.target.value)} placeholder='Description ... ' className='py-2 border-none outline-none ring-0  focus:outline-none focus:ring-0 rounded-md bg-gray-100 px-3 mt-4 w-full'></textarea>
          
          <span className='mb-3 mt-10 inline-block'></span>

          <div className="flex justify-between items-center pt-1 pb-2">
            <h1 className='text-xl font-bold text-gray-400 '>Vêtement | {calculTotalVetement()}</h1>
            <button onClick={() => addVetement()} className='px-3 py-1 rounded-md bg-gray-600 text-white'>Ajouter</button>
          </div>

          {vetements.length > 0 ? (
            <>
              <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                  <tr>
                      <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantité
                      </th>
                      <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix unitaire
                      </th>
                      <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type de vêtement
                      </th>
                      <th scope="col" className="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        
                      </th>
                  </tr>
                </thead>
                <tbody className="bg-white text-gray-600">
                  {vetements.map(vetement => {
                    if(vetement?.action !== 'delete'){
                      return (
                        <tr key={vetement.id}>
                          <td className="p-4 whitespace-nowrap text-sm font-normal">
                            <input onChange={(e) => updateVetement(e,'QTE',vetement.id)} type="number" min={0} value={vetement.qte} className='border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-1 w-full bg-gray-50  rounded-md' />
                          </td>
                          <td className="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                            <input onChange={(e) => updateVetement(e,'PRIX',vetement.id)} type="number" min={0} value={vetement.prix_unitaire} className='border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-1 w-full bg-gray-50  rounded-md' />
                          </td>
                          <td className="p-4 whitespace-nowrap text-sm font-semibold">
                            <select onChange={(e) => updateVetement(e,'TYPE',vetement.id)} value={vetement.type_vetement_id || ''} className='border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-1 w-full bg-gray-50  rounded-md'>
                              {vetementTypes.map((type :any) => (
                                <option key={type.id} value={type.id}>{type.name}</option>
                              ))}
                            </select>
                          </td>
                          <td>
                            <span onClick={() => deleteVetement(vetement.id)} className='bg-red-400 text-sm cursor-pointer pb-1 w-5 h-5 rounded-lg inline-flex justify-center items-center font-extrabold text-white'>-</span>
                          </td>
                        </tr>
                      )
                    }
                  })}
                </tbody>
              </table>
            </>
          ):(
            <div className='px-4 text-center py-3 bg-gray-100 rounded-md text-gray-400 font-semibold'>Aucun vêtement , cliquez sur le bouton "Ajouter" </div>
          )}
          
          <div className='flex justify-end px-4 border-t pt-2 text-4xl items-center font-extrabold text-gray-500 '>
            TOTAL &nbsp; <span className='px-4 inline-block text-gray-600 bg-cyan-400 rounded-md py-1'>{format_number(calculTotal().toString())}</span>
          </div>

          <div className="text-center mb-4 mt-6">
            <span onClick={handleSubmitForm} className={` ${(calculTotal() <= 0 || clientId === '' || dateLivraison === '') ? 'disabled':''} px-6 cursor-pointer rounded-md font-bold py-3 hover:bg-cyan-700 active:scale-[90%] bg-cyan-600 text-white`}>
              {load ? 'Chargement ... ':(
                <>
                  {id ? 'Mettre à jour la commande':'Enregistrer la commande'}
                </>
              )}
            </span>
          </div>
        </>
      ):(
        <FormClient addNewClient={(value) => {
          setAddNewClientState(value);
          setShowAddClient(false);
        }} onClickCallback={(value) => setShowAddClient(value)} />
      )}
      
    </div>
  )
}

export default Commande;