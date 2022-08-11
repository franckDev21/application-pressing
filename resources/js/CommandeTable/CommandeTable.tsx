import axios from 'axios'
import React, { FC, useEffect, useState } from 'react'
import Table from '../Table/Table'

type CommandeTableType = {

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
  vetements : any[]
}

type DataCommandes = {
  quantite_total_vetement : number,
  commande : CommandeModel,
  date_exp : string
}


const CommandeTable: FC<CommandeTableType> = () => {

  const [commandes,setCommandes] = useState<DataCommandes[]>([]);
  const [load,setLoad] = useState<boolean>(false);

  const [columnNumber,setColumnNumber] = useState<string|null>(null);
  const [filterRadio,setFilterRadio] = useState<string>('ALL');

  const [searchValue,setSearchValue] = useState<string>('');

  useEffect(() => {
    setLoad(true);
    axios.get('http://localhost:8000/commandes/api').then(res => {
      setLoad(false);
      setCommandes(res.data);
    }).then(err => {
      setLoad(false);
      console.log(err);
    });
  },[]);

  const filterTable = (data: DataCommandes[]):DataCommandes[] => {
    if(columnNumber !== null){
      let totalData: DataCommandes[] = [];
      if(columnNumber === 'all'){
        return myFilter(data);
      }else{
        if( (parseInt(columnNumber,10) || 0) <= data.length) {
          for (let index = 0; index < (parseInt(columnNumber,10) || 0); index++) {
            totalData.push(data[index]);
          }
        }else{
          return myFilter(data)
        }
      }
      return myFilter(totalData);
    }
    return myFilter(data);
  }

  const myFilter = (data : DataCommandes[]) => {
    return data.filter(commande => {
      if(searchValue === ''){
        return commande;
      }else if(commande.commande.client.nom.toLocaleLowerCase().includes(searchValue.toLocaleLowerCase()) 
      || commande.commande.client.prenom.toLocaleLowerCase().includes(searchValue.toLocaleLowerCase()) 
      || commande.commande.etat.toLocaleLowerCase().includes(searchValue.toLocaleLowerCase()) 
      || commande.date_exp.toLocaleLowerCase().includes(searchValue.toLocaleLowerCase())){
        return commande
      }else if(searchValue.toLocaleUpperCase() === 'ALL'){
        return commande;
      }
    });
  }

  return !load ?
    (
      <>
        {commandes.length >= 1 && (
          <>
            <div className='flex items-center justify-between mb-3'>
              <select value={columnNumber||''} onChange={(e) => setColumnNumber(e.target.value)} className='px-10 rounded-md py-1 font-bold text-gray-500 bg-gray-200 border-none'>
                <option value='all'>all</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="100">100</option>
                <option value="200">200</option>
                
              </select>
              <div>

                <label className="inline-flex items-center mr-4">
                  <input name='filtre' value={filterRadio} onChange={(e) => {
                    setFilterRadio('ALL');
                    setSearchValue('ALL');
                  }} type="radio" className="form-checkbox w-4 h-4 rounded-md text-gray-600"  />
                  <span className="ml-2 uppercase font-bold text-gray-500">ALL</span>
                </label>

                <label className="inline-flex items-center mr-4">
                  <input name='filtre' value={filterRadio} onChange={(e) => {
                    setFilterRadio('SOLDER');
                    setSearchValue('SOLDER');
                  }} type="radio" className="form-checkbox w-4 h-4 rounded-md text-green-600"  />
                  <span className="ml-2 uppercase font-bold text-gray-500">SOLDER</span>
                </label>

                <label className="inline-flex items-center mr-4">
                  <input name='filtre' value={filterRadio} onChange={(e) => {
                    setFilterRadio('AVANCER');
                    setSearchValue('AVANCER');
                  }} type="radio"  className="form-checkbox w-4 h-4 rounded-md text-orange-400" />
                  <span className="ml-2 uppercase font-bold text-gray-500">Avancer</span>
                </label>

                <label className="inline-flex items-center">
                  <input  name='filtre' value={filterRadio} onChange={(e) => {
                    setFilterRadio('IMPAYER');
                    setSearchValue('IMPAYER');
                  }} type='radio' className="form-checkbox w-4 h-4 rounded-md text-red-600"  />
                  <span className="ml-2 uppercase font-bold text-gray-500">IMPAYER</span>
                </label>
              </div>
            </div>
            <div className="mt-1 relative lg:w-full mb-4">
                <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg className="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fillRule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            ></path>
                    </svg>
                </div>
                <input value={searchValue} onChange={(e) => setSearchValue(e.target.value)} type="text" autoComplete='off' name="q" id="topbar-search"
                    className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5"
                    placeholder="Rechercher ..." />
            </div>

            <Table commandes={filterTable(commandes)} />

          </>
        )}
      </>
    ):(
      <div>Chargement ...</div>
    )
}

export default CommandeTable