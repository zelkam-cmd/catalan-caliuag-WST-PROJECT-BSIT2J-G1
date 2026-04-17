import express from "express";
import { createServer as createViteServer } from "vite";
import path from "path";
import fs from "fs";
import cors from "cors";
import { XMLParser, XMLBuilder } from "fast-xml-parser";

async function startServer() {
  const app = express();
  const PORT = 3000;
  const DATA_FILE = path.join(process.cwd(), "data.xml");

  app.use(cors());
  app.use(express.json());

  const parser = new XMLParser({
    ignoreAttributes: false,
    attributeNamePrefix: "@_",
  });
  const builder = new XMLBuilder({
    ignoreAttributes: false,
    attributeNamePrefix: "@_",
    format: true,
  });

  // Helper to read XML
  const readPatients = () => {
    try {
      if (!fs.existsSync(DATA_FILE)) {
        return [];
      }
      const xmlData = fs.readFileSync(DATA_FILE, "utf-8");
      const jsonObj = parser.parse(xmlData);
      
      if (!jsonObj.patients || !jsonObj.patients.patient) {
        return [];
      }
      
      const patients = jsonObj.patients.patient;
      return Array.isArray(patients) ? patients : [patients];
    } catch (error) {
      console.error("Error reading XML:", error);
      return [];
    }
  };

  // Helper to write XML
  const writePatients = (patients: any[]) => {
    try {
      const jsonObj = {
        patients: {
          patient: patients,
        },
      };
      const xmlContent = builder.build(jsonObj);
      fs.writeFileSync(DATA_FILE, xmlContent, "utf-8");
    } catch (error) {
      console.error("Error writing XML:", error);
    }
  };

  // API Routes
  app.get("/api/patients", (req, res) => {
    const patients = readPatients();
    res.json(patients);
  });

  app.post("/api/patients", (req, res) => {
    const patients = readPatients();
    const newPatient = {
      ...req.body,
      "@_id": Date.now().toString(), // Use timestamp as simple ID
    };
    patients.push(newPatient);
    writePatients(patients);
    res.status(201).json(newPatient);
  });

  app.put("/api/patients/:id", (req, res) => {
    const { id } = req.params;
    let patients = readPatients();
    const index = patients.findIndex((p: any) => p["@_id"] === id);
    
    if (index !== -1) {
      patients[index] = { ...patients[index], ...req.body };
      writePatients(patients);
      res.json(patients[index]);
    } else {
      res.status(404).json({ message: "Patient not found" });
    }
  });

  app.delete("/api/patients/:id", (req, res) => {
    const { id } = req.params;
    let patients = readPatients();
    const initialLength = patients.length;
    patients = patients.filter((p: any) => p["@_id"] !== id);
    
    if (patients.length < initialLength) {
      writePatients(patients);
      res.json({ message: "Patient deleted" });
    } else {
      res.status(404).json({ message: "Patient not found" });
    }
  });

  // Vite middleware for development
  if (process.env.NODE_ENV !== "production") {
    const vite = await createViteServer({
      server: { middlewareMode: true },
      appType: "spa",
    });
    app.use(vite.middlewares);
  } else {
    const distPath = path.join(process.cwd(), "dist");
    app.use(express.static(distPath));
    app.get("*", (req, res) => {
      res.sendFile(path.join(distPath, "index.html"));
    });
  }

  app.listen(PORT, "0.0.0.0", () => {
    console.log(`Server running on http://localhost:${PORT}`);
  });
}

startServer();
