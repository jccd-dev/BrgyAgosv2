import axios from "axios";

export default async function get_profile() {
    try {
      const response = await axios.get('/dashboard/get-profile');
      return response.data.users;
    } catch (error) {
      console.log(error);
      return null;
    }
  }
