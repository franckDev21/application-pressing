import React, { FC } from 'react'

type TypeFormClient = {
  onClickCallback : (value:boolean) => void
}

const FormClient: FC<TypeFormClient> = ({ onClickCallback }) => {

  return (
    <form  className="bg-white pt-4 pb-6 rounded-lg">
      <h1 className='text-xl font-bold text-gray-400 mb-3'>Nouveau Client</h1>
      <div className="flex">
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Nom du client</label>
          <input name="nom" type="text" placeholder="Nom" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md " />
        </div>
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Prénom du client</label>
          <input name="prenom" type="text" placeholder="Prénom" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
      </div>
      <div className="flex mt-4">
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Adresse email</label>
          <input name="email" type="email" placeholder="Email" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
        <div className="w-1/2 px-2">
          <label htmlFor="" className="mb-3 inline-block text-gray-500">Téléphone</label>
          <input name="tel" type="tel" placeholder="Numéro de téléphone" className="border-2 border-gray-200 outline-none focus:ring-0 focus:outline-none focus:border-gray-200 py-2 w-full bg-gray-50  rounded-md "/>
        </div>
      </div>

      <div className="text-center mt-6">
        <span onClick={() => onClickCallback(false)}  className="px-6 mr-3 rounded-md font-bold py-2 cursor-pointer bg-cyan-600 text-white">Retour</span>
        <span className="px-6 cursor-pointer rounded-md font-bold py-2 bg-cyan-600 text-white">Ajouter</span>
      </div>
    </form>
  );
}

export default FormClient