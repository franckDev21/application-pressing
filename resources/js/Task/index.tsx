import React, { FC, useState } from 'react'
import './index.scss';

type TaskType = {
  title : string
}

const index: FC<TaskType> = ({ title }) => {

  const [tasks,setTasks] = useState<any>([]);

  return (
    <div className="max-w-7xl mt-4 mx-auto sm:px-6 lg:px-8">
      <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div className="p-6">
              You're logged in! hk
          </div>
      </div>
    </div>
  )
}

export default index