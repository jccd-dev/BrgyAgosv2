import axios from "axios";

async function get_profile() {
    try {
      const response = await axios.get('/dashboard/get-profile');
      return response.data.users;
    } catch (error) {
      console.log(error);
      return null;
    }
  }

async function get_families() {
    try {
        const response = await axios.get('/dashboard/all-families');
        return response.data.families
    } catch (error) {
        console.log(error)
        return null
    }
}

async function get_households() {
    try {
        const response = await axios.get('/dashboard/all-households');
        return response.data.households
    } catch (error) {
        console.log(error)
        return null
    }
}

export {
    get_profile,
    get_families,
    get_households
}
