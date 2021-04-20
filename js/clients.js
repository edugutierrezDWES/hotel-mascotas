
document.addEventListener('DOMContentLoaded', () => {
   getClientes()
})

  const getClientes = async()=>{
      let send = {
            method:"GET",
            headers:{
              'Content-Type' : 'application/json'
            }
      }
      try {
        let res= await fetch("./controllers/clientes_controller.php",send);
        let data= await res.json();
        console.log(data)
        
      } catch (error) {
        console.log("Ha ocurrido el siguiente error "+error);
      }
  }