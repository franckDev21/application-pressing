import axios from 'axios';
import React, { FC, useEffect, useState } from 'react'

type TypeFormClient = {
  onClickCallback : (value:boolean) => void
  addNewClient : (value: boolean) => void
}

const FormClient: FC<TypeFormClient> = ({ onClickCallback, addNewClient }) => {

  const [nom,setNom] = useState('');
  const [prenom,setPrenom] = useState('');
  const [email,setEmail] = useState('');
  const [tel,setTel] = useState('');

  const [load,setLoad] = useState(false);

  const [sessionMsgError,setSessionMsgError] = useState('');
  const [sessionMsgSuccess,setSessionMsgSuccess] = useState('');

  const handleSubmitForm = () => {
      setSessionMsgSuccess('');
      setSessionMsgError('');
    if(nom !== '' && prenom !== '' && email !== '' && tel !== ''){
      const data = {
        nom,
        prenom,
        email,
        tel
      };
      setLoad(true);
      axios.post('http://localhost:8000/clients/api',data).then(res => {
        setLoad(false);
        if(res.data.success){
          setSessionMsgSuccess(res.data.success);
          addNewClient(true);
        }
      }).catch(err => {
        setLoad(false);
        setSessionMsgError(err.response.data.message);
      });
    }else{
      setSessionMsgError('Veuillez remplir tous les champs du formulaire !');
    }
  }

  const showMessageSession = (type = 'SUCCESS'): number => {
    let i = 0;
    let id = window.setInterval(() => {
      i++
      console.log(`i : ${i+1}`);
      if(i === 8){
        window.clearInterval(id);
        setSessionMsgSuccess('');
        setSessionMsgError('');
      }
    },1000);

    return id;
  }

  useEffect(() => {
    let id = showMessageSession();
    return () => {
      window.clearInterval(id);
    }
  },[sessionMsgError]);

  useEffect(() => {
    let id = showMessageSession();
    return () => {
      window.clearInterval(id);
    }
  },[sessionMsgSuccess]);

  return (
    <form  className="bg-white pt-4 pb-6 rounded-lg">
      <h1 className='text-xl font-bold text-gray-400 mb-3'>Nouveau Client</h1>
      {sessionMsgError  && <div className="p-4 bg-red-100 text-red-400 font-bold text-2xl mb-3 rounded-md text-center">{sessionMsgError}</div>}
      {sessionMsgSuccess  && <div className="p-4 bg-green-100 text-green-400 font-bold text-2xl mb-3 rounded-md text-center">{sessionMsgSuccess}</div>}
      <div className="flex">
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Nom du client</label>
          <input value={nom} onChange={(e) => setNom(e.target.value)} type="text" placeholder="Nom" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md " />
        </div>
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Prénom du client</label>
          <input value={prenom} onChange={(e) => setPrenom(e.target.value)} type="text" placeholder="Prénom" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
      </div>
      <div className="flex mt-4">
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Adresse email</label>
          <input value={email} onChange={(e) => setEmail(e.target.value)}  type="email" placeholder="Email" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Téléphone</label>
          <input value={tel} onChange={(e) => setTel(e.target.value)}  type="tel" placeholder="Numéro de téléphone" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
      </div>

      <div className="text-center mt-6">
        <span onClick={() => onClickCallback(false)}  className="px-6 mr-3 rounded-md font-bold py-2 cursor-pointer bg-cyan-600 text-white">Retour</span>
        <span onClick={handleSubmitForm} className="px-6 cursor-pointer rounded-md font-bold py-2 bg-cyan-600 text-white">{load ? 'Chargement ...':'Ajouter'}</span>
      </div>
    </form>
  );
}

export default FormClient